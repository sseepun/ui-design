
function radians(degrees, origin){
    return degrees * Math.PI / 180;
}
function radians2(degrees, origin){
    let res = degrees * Math.PI / 180;
    if(origin===undefined) return res;
    else{
        let final = res,
            pi2 = Math.PI * 2,
            s = Math.abs(res - origin);
        if(Math.abs(res - pi2 - origin) < s) final = res - pi2;
        else if(Math.abs(res + pi2 - origin) < s) final = res + pi2;
        return final % pi2;
    }
}
function distance(x1, y1, x2, y2){
    return Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2));
}
function map(value, start1, stop1, start2, stop2){
    return (value - start1) / (stop1 - start1) * (stop2 - start2) + start2
}
