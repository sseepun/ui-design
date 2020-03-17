<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fundamental</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="booth-canvas"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <script src="js/utils.js"></script>
    <script type="module">
        import * as THREE from '../../extensions/three/build/three.module.js';
        import { OrbitControls } from '../../extensions/three/examples/jsm/controls/OrbitControls.js';
        import { GLTFLoader } from '../../extensions/three/examples/jsm/loaders/GLTFLoader.js';
        import { RGBELoader } from '../../extensions/three/examples/jsm/loaders/RGBELoader.js';
        import { EquirectangularToCubeGenerator } from '../../extensions/three/examples/jsm/loaders/EquirectangularToCubeGenerator.js';
        import { PMREMGenerator } from '../../extensions/three/examples/jsm/pmrem/PMREMGenerator.js';
        import { PMREMCubeUVPacker } from '../../extensions/three/examples/jsm/pmrem/PMREMCubeUVPacker.js';

        var container, stats, controls;
        var camera, scene, renderer;
        var object;

        init();
        function init(){
            container = document.querySelector('div#booth-canvas');

            camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.001, 1000);
            camera.position.set(0, 0, 30);
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
            .load('lebombo_1k.hdr', function(hdr){
                var cubeGenerator = new EquirectangularToCubeGenerator(hdr, {resolution: 1024});
                cubeGenerator.update(renderer);

                var pmremGenerator = new PMREMGenerator(cubeGenerator.renderTarget.texture);
                pmremGenerator.update(renderer);

                var pmremCubeUVPacker = new PMREMCubeUVPacker(pmremGenerator.cubeLods);
                pmremCubeUVPacker.update(renderer);

                var envMap = pmremCubeUVPacker.CubeUVRenderTarget.texture;

                // Load GLTF model
                new GLTFLoader(manager).setPath('assets/booth/')
                .load('Dw_booth_V_02_GLTF.gltf', function(gltf){
                    gltf.scene.children[0].children.map(function(d, i){
                        if(d.isMesh){
                            d.material.side = THREE.DoubleSide;
                            d.material.envMap = envMap;
                            d.material.wireframeLinewidth = 0.1;
                            d.castShadow = true;
                            d.receiveShadow = true;
                        }
                    });

                    object = gltf.scene.children[0];
                    scene.add(gltf.scene);
                    
                    object.position.set(0, 3, 0);
                    object.rotation.set(0, radians2(-720), 0);
                    
                    animate();
                });

                pmremGenerator.dispose();
                pmremCubeUVPacker.dispose();

                scene.background = cubeGenerator.renderTarget;
                // scene.background = new THREE.Color(0xFFFFFF);
            });

            renderer = new THREE.WebGLRenderer({antialias: true, alpha: true});
            renderer.shadowMap.enabled = true;
            renderer.shadowMap.type = THREE.PCFSoftShadowMap;
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
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }
        function animate(){
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
        }

        $('.toggle-wireframe').click(function(){
            if($(this).hasClass('active')){
                $(this).removeClass('active');
                object.children[0].children[0].material.wireframe = false;
            }else{
                $(this).addClass('active');
                object.children[0].children[0].material.wireframe = true;
            }
        });
    </script>
</body>
</html>
