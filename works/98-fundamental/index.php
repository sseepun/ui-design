<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fundamental</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="car-canvas"></div>   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <script src="js/utils.js"></script>
    <script type="module">
        import * as THREE from '../../extensions/three/build/three.module.js';
        import { GLTFLoader } from '../../extensions/three/examples/jsm/loaders/GLTFLoader.js';
        import { RGBELoader } from '../../extensions/three/examples/jsm/loaders/RGBELoader.js';
        import { EquirectangularToCubeGenerator } from '../../extensions/three/examples/jsm/loaders/EquirectangularToCubeGenerator.js';
        import { PMREMGenerator } from '../../extensions/three/examples/jsm/pmrem/PMREMGenerator.js';
        import { PMREMCubeUVPacker } from '../../extensions/three/examples/jsm/pmrem/PMREMCubeUVPacker.js';
        import { OrbitControls } from '../../extensions/three/examples/jsm/controls/OrbitControls.js';
        
        var container, stats, controls;
        var camera, scene, renderer;
        var object;
        var fps = 0, scrollReady = false;

        init();
        function init(){
            container = document.querySelector('div#car-canvas');

            camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.001, 1000);
            camera.position.set(0, 0, 25);
            camera.rotation.set(0, 0, 0);

            scene = new THREE.Scene();
            
            // Loader manager
            var manager = new THREE.LoadingManager();
            manager.onProgress = function(url, itemsLoaded, itemsTotal){
                console.log('Model loaded - '+Math.round(itemsLoaded / itemsTotal * 100)+'%');
            };
            manager.onStart = function(url, itemsLoaded, itemsTotal){ console.log('Model - Start loading'); };
            manager.onLoad = function(){ console.log('Model - Loading complete!'); };
            manager.onError = function(url){ console.log('Model - Error loading '+url); };

            new RGBELoader().setDataType(THREE.UnsignedByteType).setPath('assets/hdr/')
            .load('studio_small_07_1k.hdr', function(hdr){
                var cubeGenerator = new EquirectangularToCubeGenerator(hdr, {resolution: 1024});
                cubeGenerator.update(renderer);

                var pmremGenerator = new PMREMGenerator(cubeGenerator.renderTarget.texture);
                pmremGenerator.update(renderer);

                var pmremCubeUVPacker = new PMREMCubeUVPacker(pmremGenerator.cubeLods);
                pmremCubeUVPacker.update(renderer);

                var envMap = pmremCubeUVPacker.CubeUVRenderTarget.texture;

                // Load GLTF model
                var loader = new GLTFLoader(manager).setPath('assets/bmw/');
                loader.load('model.gltf', function(gltf){
                    scene.add(gltf.scene);

                    gltf.scene.children.map(function(d, i){
                        d.children.map(function(dd, j){
                            if(i==0){
                                // Metalic Black
                                if([0, 3, 4].indexOf(j)>-1){
                                    dd.material.color = new THREE.Color(0x000000);
                                }
                                // Interior
                                else if([1].indexOf(j)>-1){
                                    dd.material.color = new THREE.Color(0x111111);
                                }else if([6, 8].indexOf(j)>-1){
                                    dd.material.color = new THREE.Color(0x000000);
                                }
                            }else if(i==1){
                                // Metalic Black
                                if([4].indexOf(j)>-1){
                                    dd.material.color = new THREE.Color(0x000000);
                                }else if([12, 15].indexOf(j)>-1){
                                    dd.material.color = new THREE.Color(0x111111);
                                }
                                // Interior
                                else if([6].indexOf(j)>-1){
                                    dd.material.color = new THREE.Color(0x000000);
                                }
                                // Back Lights
                                else if([8].indexOf(j)>-1){
                                    // dd.material.color = new THREE.Color(0x111111);
                                }
                                // Front Lights
                                else if([16, 18, 19, 20, 21].indexOf(j)>-1){
                                    if(j==16){
                                        dd.material.transparent = true;
                                    }
                                }
                                // Glass
                                else if([14].indexOf(j)>-1){
                                    dd.material.transparent = true;
                                    // dd.material.opacity = 0.9;
                                    // dd.material.color = new THREE.Color(0x111111);
                                }
                            }else if(i==2){
                                // Metalic Black
                                if([4].indexOf(j)>-1){
                                    dd.material.color = new THREE.Color(0x000000);
                                }
                            }
                        });

                        // d.position.set(0, -100, 0);
                        // d.rotation.set(0, 0, 0);
                    })
                    
                    gltf.scene.traverse(function(child){
                        if(child.isMesh){
                            child.material.side = THREE.DoubleSide;
                            child.material.envMap = envMap;
                            child.material.wireframeLinewidth = 0.1;
                        }
                    });

                    fps = 60; animate();
                });

                pmremGenerator.dispose();
                pmremCubeUVPacker.dispose();

                // scene.background = cubeGenerator.renderTarget;
                // scene.background = new THREE.Color(0xFFFFFF);
            });

            renderer = new THREE.WebGLRenderer({antialias: true, alpha: true});
            renderer.setClearColor(0x000000, 0);
            renderer.setPixelRatio(window.devicePixelRatio);
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.gammaOutput = true;

            
            controls = new OrbitControls( camera, renderer.domElement );
            controls.enableDamping = true;
            controls.dampingFactor = 0.05;
            controls.screenSpacePanning = false;
            controls.minDistance = 10;
            controls.maxDistance = 100;
            controls.maxPolarAngle = Math.PI / 2;
            
            container.appendChild(renderer.domElement);

            window.addEventListener('resize', onWindowResize, false);
        }
        function onWindowResize(){
            if(scrollReady){
                scrollReady = false;
            }
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }
        function animate(){
            if(fps>0){
                scrollReady = false;
                setTimeout(function(){
                    requestAnimationFrame(animate);
                }, 1000/fps);
            }else scrollReady = true;
            controls.update();
            renderer.render(scene, camera);
        }
    </script>
</body>
</html>
