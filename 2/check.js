function check() {
    var required = ["name1", "name2", "tel1", "tel2", "tel3", "email1", "email2", "text"];
    var flag = 1;

    for(i=0;i<required.length;i++){
        var obj = document.getElementsByName(required[i]);

        //未入力チェック
        if(obj[0].value == ""){
            document.getElementById(required[i]).style.backgroundColor = '#FFE4E1';
            flag = 0
        }else{
            document.getElementById(required[i]).style.backgroundColor = '#FFFFFF';
        }
    }

    if(flag == 1){
        return true;
    }else{
        return false;
    }
}
