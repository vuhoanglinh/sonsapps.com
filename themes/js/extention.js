function changetitle(str) { 
	str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");  
	str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");  
	str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");  
	str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");  
	str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");  
	str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");  
	str= str.replace(/đ/g,"d"); 
	str= str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ầ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g,"A");  
	str= str.replace(/È|É|È|Ẻ|Ẽ|Ê|Ề|Ế|Ề|Ể|Ễ/g,"E");  
	str= str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g,"I");  
	str= str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g,"O");  
	str= str.replace(/Ù|Ù|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g,"U");  
	str= str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g,"Y");  
	str= str.replace(/Đ/g,"D");
        str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
        /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
        str = str.replace(/-+-/g, "-"); //thay thế 2- thành 1-
        str = str.replace(/^\-+|\-+$/g, "");
        str = str.toLowerCase();
    //cắt bỏ ký tự - ở đầu và cuối chuỗi
       	return str;  
}

function replaceurl(str)
{
	str = str.replace(/\\/g,"/");
	return str;
}

function keypress(e)
{
    var keypressed = null;
    if (window.event){
	keypressed = window.event.keyCode;
    }
    else{ 
    keypressed = e.which;
    }
    if (keypressed < 48 || keypressed > 57){
	if (keypressed == 8 || keypressed == 127){
		return true;
	}
	return false;
    }
}

function resize()
{
      var $left   = $('#left');
      var $main   = $('#main');
      var $footer = $('#footer');

      var temp =  0;

      if($left.height() > $main.height())
      {
        temp =  $left.height();
      }
      else
      {
        temp =  $main.height();
      }
      var height = temp + $footer.height();     
      $('#content').height(height);
}

function getError(value,element)
{
    var error = '<span for="'+element+'" class="help-block error">'+value+'</span>';
    return error;
} 

function NextPagging(maxlength) {
  var position = $('.pagination>div').position();
  var left = position.left;
  var max = -maxlength;
  if (left > max) {
    $('.pagination>div').animate({ left: '-=50px' }, 500);
  }
}

function PrevPagging(minlength) {   
  var position = $('.pagination>div').position();
  var left = position.left;
  if (left < minlength) {
    $('.pagination>div').animate({ left: '+=50px' }, 500);
  }
}

function disableEnterKey(e)
{
     var key;

     if(window.event)
          key = window.event.keyCode;    //IE
     else
          key = e.which;     //firefox
     if(key == 13)
          return false;
     else
          return true;
}

function replaceKeySearch(key)
{
  var q   = key;
  q       = q.replace(/!|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\#|\[|\]|~|$|_/g, "");
  return q;
}
