function addToCart(itemId) {
            $.ajax({
                type:'POST',
                async: false,
                url:"/cart/addtocart/prod/"+itemId+'/',
                dataType: 'json',
                success: function(data){
                    if(data['success']){
                        $('#cartCntItems').html(data['cntItems']);

                        $('#addCart_'+ itemId).hide();
                        $('#removeCart_'+ itemId).show();

                    }
                }
            });
}

function removeToCart(itemId) {
    $.ajax({
        type:'POST',
        async: false,
        url:"/cart/removetocart/prod/"+itemId+'/',
        dataType: 'json',
        success: function(data){
            if(data['success']){
                $('#cartCntItems').html(data['cntItems']);

                $('#removeCart_'+ itemId).hide();
                $('#addCart_'+ itemId).show();
            }
        }
    });
}

function conversion(itemId) {
    col=$('#item_'+itemId).val()*$('#itemprice_'+itemId).attr('value');
    $('#itemrealprice_'+itemId).html(col);
}

function register() {
    $('.registerBox').show();
    $('.loginBox').hide()
}
function authorization() {
    $('.loginBox').show();
    $('.registerBox').hide();
}

function getItems(obj_form) {
    var Items={};
    $('input,textarea',obj_form).each(function(){
        if(this.name&&this.name!=''){
            Items[this.name]=this.value;
            console.log('Items['+this.name+"]:"+Items[this.name]);
        }
    });
    return  Items;
}

function registerUser() {
    var postItems = getItems('.register');
    console.log(postItems);
    $.ajax({
        type: 'POST',
        async: false,
        url: "/user/register/",
        data: postItems,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            if (data['success']) {
                alert(data['message']);
                $('.registerBox').hide();

                $('#buttonAuth').hide();
                $('#userLink').html(data['userName']);
                $('#userName').show();
                setTimeout(function(){
                    location.reload();
                }, 100);
            } else {
                alert(data['message']);
            }
        }
    });
}
function login() {
    var postItems = getItems('.login');
            $.ajax({
                type:'POST',
                async:false,
                url:"/user/login/",
                data:postItems,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    console.log(data['userName']);
                    if(data['success']){
                        $('.loginBox').hide();

                        $('#buttonAuth').hide();
                        $('#userLink').html(data['userName']);
                        $('#userName').show();
                        setTimeout(function(){
                            location.reload();
                        }, 100);
                    }else{
                        alert(data['message']);
                    }
                }
            });
}
function updateUser() {
    var postItems = getItems('#tableBox');
    $.ajax({
        type:'POST',
        async:false,
        url:"/user/update/",
        data:postItems,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            if(data['success']) {
                alert(data['message']);
                $('#userLink').html(data['name']);
                setTimeout(function(){
                    location.reload();
                }, 100);
            }else{
                alert(data['message']);
            }

        }
    });
}
function saveOrder() {
    var postItems = getItems('#ordersBox');
    $.ajax({
        type:'POST',
        async:false,
        url:"/cart/saveorder/",
        data:postItems,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            if(data['success']) {
                alert(data['message']);
                document.location='/';
            }else{
                alert(data['message']);
            }

        }
    });
}
function closeLogin() {
    $('div.loginBox').hide();
}

function closeRegister() {
    $('div.registerBox').hide();
}

function saveInXML(){
    console.log('123');
    $.ajax({
        type:'POST',
        async:false,
        url:"/admin/goods/saveInXML/",
        dataType:'html',
        success:function(data){
            if(data) {
                alert('XML Файл загружен');
            }
        }
    });
}