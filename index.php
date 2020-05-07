

<? header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Учет количества посещений страницы</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <style type="text/css">
            .forms{
                    background: #fff;
                    border: 3px double #cccccc;
                    display: none;
                    margin: 0px auto;
                    margin-top:200px;
                    padding: 10px;
                    width: 420px;
            }
            .section_form{
                            border: 0px solid red;
                            margin: 5px 0px;
            }
            .label{
                    border: 0px solid red;
                    color: #949494;
                    float:left; 
                    font: 14px Verdana;
                    padding-right: 5px;
                    text-align: right;
                    width: 170px;  
            }
            .forms input, .forms textarea{
                                        background: #ffffff;
                                        border: 1px solid #cccccc;
                                        outline: none;
                                        resize: none;
                                        width: 200px;
            }
            .forms textarea{
                            overflow: auto;
            }
            .forms input.but{
                            background: #cccccc;
                            border: 1px solid #a1a19f;
                            display: block;
                            height: 21px;
                            left: 0px;
                            margin: 0px auto;
                            padding: 0px;
                            position: relative;
                            top: 0px;
                            outline: none;
                            width: 170px;
            }
            #but_reset{
                        border: 1px solid #949494; 
                        background: #cccccc; 
                        margin-left: 5px; 
                        height: 16px; 
                        font-size: 11px; 
                        position: relative;
            }
        </style>
        <script type="text/javascript">
            /* Получение данных из формы регистрации */
            function getDataForm(){
                var list_id_fields = ['name','surname','patronymic'], empty_fl = false;
                var str_cookie = 'rec_cookie=';
                    
                for (i=0; i<list_id_fields.length; i++){
                    str_cookie += list_id_fields[i] + ':' + escape(document.getElementById(list_id_fields[i]).value) + '|';
                    if (!document.getElementById(list_id_fields[i]).value)
                        empty_fl = true;
                }
                if (!empty_fl){         
                    str_cookie += 'counter:1|date:'+ getDateFormat(new Date());
                    SetCookie(str_cookie,7);
                    document.getElementById('form_reg').style.display = 'none';
                    document.getElementById('name_user').innerHTML = document.getElementById('name').value;
                    document.getElementById('counter').value = '1';
                    document.getElementById('date_visiting').value =  'Сейчас';  
                    document.getElementById('form_greeting').style.display = 'block';
                }
            }
            /* Функции по работе с cookie-записями */
            /* Создание cookie-записи */
            /*
                str - содержимое записи
                expires_days - срок хранения в днях
            */
            function SetCookie(str,expires_days){
                var now_date = new Date();
                now_date.setTime(now_date.getTime() + 1000 * 60 * 60 * 24 * expires_days);
                document.cookie = str + ';expires='+now_date.toGMTString();  
            }
            /* Чтение cookie-записи */
            function readCookie(){
                var cookies_str = document.cookie, temp, find_cookie = false, new_cookie;
                var cookies_arr = cookies_str.split(";");
                for (i=0; i<cookies_arr.length; i++){
                    temp = cookies_arr[i].split('=');
                    //temp['name_cookie','value_cookie']
                    if (temp[0] == 'rec_cookie'){
                        new_cookie = cookies_arr[i];
                        find_cookie = true;
                        temp = temp[1].split('|')
                        //temp['value','value',...]
                        for (j=0; j<temp.length; j++)
                            if (temp[j].split(':')[0] == 'name')
                                document.getElementById('name_user').innerHTML = unescape(temp[j].split(':')[1]);
                            else if (temp[j].split(':')[0] == 'counter')
                            {
                    
                                var count = parseInt(temp[j].split(':')[1])+1;
                                document.getElementById('counter').value = count;
                                new_cookie = new_cookie.replace(/counter:[0-9]+/,'counter:'+ count)
                            }
                            else if (temp[j].split(':')[0] == 'date'){
                                document.getElementById('date_visiting').value =  unescape(temp[j].split(':')[1]);   
                                var st = new_cookie.lastIndexOf('date:')
                                new_cookie = new_cookie.substring(0,st+5) + getDateFormat(new Date());
                            }
                        /* Устанавливаем новую cookie-запись */
                        SetCookie(new_cookie,7); 
                        document.getElementById('form_greeting').style.display = 'block';
                    } 
                }
                if(!find_cookie)
                {
                    document.getElementById('form_reg').style.display = 'block';  
                }
            }
            /* Получение даты */
            /*
                date -объект даты
            */
            function getDateFormat(date){
                var str_date_begin = date.getDate();
                var str_date_end = date.getHours()+'-'+date.getMinutes()+'-'+date.getSeconds();
                switch (date.getMonth()){
                    case 0 :    date = 'Января';
                                break;
                    case 1 :    date ='Февраля';
                                break;
                    case 2 :    date = 'Марта';
                                break;
                    case 3 :    date = 'Апреля';
                                break;
                    case 4 :    date = 'Мая';
                                break;
                    case 5 :    date = 'Июня';
                                break;
                    case 6 :    date = 'Июля';
                                break;
                    case 7 :    date = 'Августа';
                                break;
                    case 8 :    date = 'Сентября';
                                break;
                    case 9 :    date = 'Октября';
                                break;
                    case 10 :   date = 'Ноября';
                                break;
                    case 11 :   date = 'Декабря';
                }
                return str_date_begin+' '+escape(date)+' '+str_date_end;
            } 
            /* Удаление начальных и конечных пробелов в строке */
            function trim(str)
            {
                return str.replace(/^\s+/,'').replace(/\s+$/g,'');
            }
            /* Имитация клика кнопки */
            function changeState(obj,action){
                if (action){
                    obj.style.top = '1px';
                    obj.style.left = '1px';
                }
                else{
                    obj.style.top =  '0px';
                    obj.style.left = '0px';     
                }
            }
            function exit(){
                document.cookie = "rec_cookie=;expires=Thu, 01-Jan-70 00:00:01 GMT";
                location.href = 'http://y95327t3.beget.tech/1/резюме'; 
            }
        </script>
    </head>
    <body onload="readCookie();">
        <!-- Регистрация -->
        
        <form action='http://y95327t3.beget.tech/1/резюме' id='form_reg' class='forms' onsubmit='getDataForm(); return false'>
            <h3 style='text-align: center; margin: 0px'>Регистрация</h3>
            <div class='section_form'>
                <div class='label'>Фамилия :</div> <input type='text' name='surname' id='surname' value='' onblur='this.value = trim(this.value)'/>
            </div>
            <div class='section_form'>
                <div class='label'>Имя :</div> <input type='text' name='name' id='name' value='' onblur='this.value = trim(this.value)'/>
            </div>
            <div class='section_form'>
                <div class='label'>Отчество :</div> <input type='text' name='patronymic'  id='patronymic' value='' onblur='this.value = trim(this.value)'/>
            </div>
            <div class='section_form'>
                <input type='submit' value='Зарегистрироваться' class='but' onmousedown="changeState(this,1)" onmouseup="changeState(this,0)"/>
            </div>
        </form>
       
        <!-- Приветствие -->
        <form action='http://y95327t3.beget.tech/1/резюме' method='post' id='form_greeting' class='forms' onsubmit='return false' style="display: none;">
            <h3 style='text-align: center; margin: 0px'>Здравствуйте <span id="name_user"></span>!</h3>
            <div class='section_form'>
                <div class='label'>Посетили страницу :</div> <input type='text'  value='' id="counter" style="width: 20px;"/><span style="color: #949494;"> раз</span><button id='but_reset' onmousedown="changeState(this,1)" onmouseup="changeState(this,0)" onclick="exit();">Сбросить</button>
            </div>
            <div class='section_form'>
                <div class='label'>Последний раз были :</div> <input type='text'  id='date_visiting' value='' />
            </div>
            <button name="write" class="j-submit-report" onclick="window.location.href='http://y95327t3.beget.tech/1/резюме'">ВОЙТИ</button>
        </form>
       
    </body>
</html>