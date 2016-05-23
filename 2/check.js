function check() {
    var required = ["name1", "name2", "tel", "email", "text"];
    var flag1 = 1;
    var regexp = new RegExp('');

    for(i=0;i<required.length;i++){
        var obj = document.getElementById(required[i]);
        var flag2 = 0

        for(j=0;j<obj.children.length-1;j++){

            if(obj.children[j].value == ""){
                flag2 = 1;
                flag1 = 0;
            }

            if(required[i] == "tel"){
                if( /[\D]+/.test(obj.children[j].value)){
                    flag2 = 2;
                    flag1 = 0;
                }
            }

            if(flag2 == 1){
                obj.children[obj.children.length - 1].innerHTML = "未入力です";
                // obj.children[j].style.backgroundColor = "#FFE4E1";
            }else if(flag2 == 2){
                obj.children[obj.children.length - 1].innerHTML = "半角数字のみ入力してください";
                // obj.children[j].style.backgroundColor = "#FFE4E1";
            }else{
                obj.children[obj.children.length - 1].innerHTML = "";
                // obj.children[j].style.backgroundColor = "#FFFFFF";
            }

        }
    }

    if(flag1 == 1){
        return true;
    }else{
        return false;
    }
}
