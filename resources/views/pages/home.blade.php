@extends('pages.layouts')
@section('content')
<div class="container mt-5">
    <div class="row" style="background-color: #DBA901; /* For browsers that do not support gradients */
  background-image: linear-gradient(to bottom right, #0B4C5F, yellow); border-radius:5px">
        <div class="col-xl-5 offset-xl-4 mt-5 mb-5">
        <form action="{{route('render')}}" method="POST" >
            @csrf
            <h3 class="text-center" style="color: #8A2908; font-weight: 900"> CHỌN WEB </h3>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios1" value="1"@if ($value==1){{"checked"}} @endif>
              <label  style="color: #3B0B0B; font-size: 15px; font-weight:5px" class="form-check-label" for="exampleRadios1">
              Quỳnh-Trinh : xemnhanh.info - PAGE: xem nhanh plus
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios2" value="2" @if ($value==2){{"checked"}} @endif>
              <label  style="color: #3B0B0B; font-size: 15px; font-weight:5px" class="form-check-label" for="exampleRadios2">
                Phương : showbiz.xemnhanh.info - PAGE: xem nhanh plus
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios3" value="3" @if ($value==3){{"checked"}} @endif>
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios3">
                Thúy : xehay9.com  - PAGE: Load-News
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios5" value="5" @if ($value==5){{"checked"}} @endif>
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios5">
                Thúy : phim.xehay9.com  - PAGE: Load-News
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios4" value="4" @if ($value==4){{"checked"}} @endif>
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios4">
                Hưng-Hoang-Nho : ia.xehay9.com - PAGE: Xem-tin-Nhanh
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios9" value="9" @if ($value==9){{"checked"}} @endif>
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios9">
                Quyên : phim.xem.plus - PAGE: Cuộc Sống Muôn Màu
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios6" value="6" @if ($value==6){{"checked"}} @endif >
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios6">
                WEB: docnhanh.online - PAGE: Xem Nhanh Amazing
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios7" value="7" @if ($value==7){{"checked"}} @endif >
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios7">
                WEB: khelsanchar.com - PAGE: Unique Nepal
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios8" value="8" @if ($value==8){{"checked"}} @endif >
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios8">
                WEB: xem.plus - PAGE: Cuộc Sống Muôn Màu
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios10" value="10" @if ($value==10){{"checked"}} @endif >
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios10">
                Đông- Thailand WEB: ia.khelsanchar.com - PAGE: Unique Nepal
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios11" value="11" @if ($value==11){{"checked"}} @endif >
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios11">
                Hưng - Arap WEB: news.docnhanh.online - PAGE: Kassy News
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios12" value="12" @if ($value==12){{"checked"}} @endif >
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios12">
                 WEB: tv.xehay9.com - PAGE: Load-News
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="select_web" id="exampleRadios13" value="13" @if ($value==13){{"checked"}} @endif >
              <label style="color:#3B0B0B; font-size: 15px" class="form-check-label" for="exampleRadios13">
                 WEB: ia.live48today.com - PAGE: Media-News-Today-Live
              </label>
            </div>
                <div class="form-group text-center mt-3">
                  <label style="color: red; font-size: 20px; font-weight: 900"> NHẬP ID BÀI VIẾT </label>
                  <input type="text" class="form-control" name="post_id" >
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary " style="background: #FFBF00; color:#8A0808"> Đăng IA </button>
                </div>
                <div class="text-center mt-5">
                  <div id="scriptquote" style="background-color: #DBA901; /* For browsers that do not support gradients */
  background-image: linear-gradient(to bottom right, #0B4C5F, #886A08); border-radius:5px"></div>
                </div>
                
        </form>
        @if (isset($status)&&($status=='success'))
          <script type="text/javascript">
        setTimeout(function(){ alert('Thành Công!'); },100);
          </script>
        @endif
        @if (isset($notice))
        <div class="alert alert-danger mt-5">
          <strong>Chú Ý !! </strong> {{$notice}}
       </div>
        @endif
        </div>
        
        <div class="col-xl-2 offset-xl-1  mt-5 mb-5">
            <a href="{{ route('fixDraft') }}" class="btn btn-primary" style="padding: 15px;">Fix lỗi  
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-globe" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4H2.255a7.025 7.025 0 0 1 3.072-2.472 6.7 6.7 0 0 0-.597.933c-.247.464-.462.98-.64 1.539zm-.582 3.5h-2.49c.062-.89.291-1.733.656-2.5H3.82a13.652 13.652 0 0 0-.312 2.5zM4.847 5H7.5v2.5H4.51A12.5 12.5 0 0 1 4.846 5zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5H7.5V11H4.847a12.5 12.5 0 0 1-.338-2.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12H7.5v2.923c-.67-.204-1.335-.82-1.887-1.855A7.97 7.97 0 0 1 5.145 12zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11H1.674a6.958 6.958 0 0 1-.656-2.5h2.49c.03.877.138 1.718.312 2.5zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12h2.355a7.967 7.967 0 0 1-.468 1.068c-.552 1.035-1.218 1.65-1.887 1.855V12zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5h-2.49A13.65 13.65 0 0 0 12.18 5h2.146c.365.767.594 1.61.656 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4H8.5V1.077c.67.204 1.335.82 1.887 1.855.173.324.33.682.468 1.068z"/>
</svg></a>
        </div>
    </div>
    
  <style>
#scriptquote{color: #F6E3CE; font-weight: bold; background:#ecf0f1; text-align: center;}
#scriptquote:hover{color:#2ecc71}
</style>

<script type="text/Javascript">

function random_quote()
{ 
quote_arr= new Array();
quote_arr[1]="“Tôi không tiếc về những việc mình đã làm, tôi chỉ tiếc những việc mình đã không làm khi có cơ hội”";
quote_arr[2]="“Thách thức là điều làm cho cuộc sống trở nên thú vị và vượt qua chúng là những gì tạo nên ý nghĩa cuộc sống.”";
quote_arr[3]="“Để thành công, khao khát thành công của bạn phải lớn hơn nỗi sợ thất bại”";
quote_arr[4]="“Tôi biết ơn những người đã nói không với mình. Nhờ họ mà tôi tự mình làm lấy mọi thứ.”";
quote_arr[5]="“Cuộc đời ngắn ngủi, hãy sống trọn từng phút giây. Tình yêu khan hiếm, hãy biết nắm lấy. Giận dữ là không tốt, hãy loại bỏ nó. Những kỉ niệm luôn ngọt ngào, hãy trân trọng chúng.”";
quote_arr[6]="“Khi bạn nói “Thật là khó”, điều đó thực sự có nghĩa rằng “Tôi không đủ mạnh mẽ để đấu tranh vì nó”. Ngừng ngay việc kêu ca. Hãy suy nghĩ tích cực.”";
quote_arr[7]="“Đừng lo lắng về thất bại, hãy lo về những cơ hội bạn bỏ lỡ khi bạn thậm chí không hề cố gắng.”";
quote_arr[8]="“Thất bại lớn nhất bạn có thể gặp phải trong đời là mắc phải sai lầm không bao giờ cố gắng.”";
quote_arr[9]="“Chờ đợi một điều bạn biết có thể chẳng bao giờ xảy ra thật không dễ gì, nhưng việc từ bỏ khi bạn biết đó là những gì bạn muốn thậm chí còn khó khăn hơn.”";
quote_arr[10]="“Quên đi tất cả những lí do không thể và chỉ tin vào một lí do cho thấy rằng điều đó là có thể”";
 
arr_leng  = quote_arr.length-1;
random_arr= Math.floor((Math.random()*arr_leng)+1);
document.getElementById('scriptquote').innerHTML=quote_arr[random_arr];
}  
setInterval(random_quote, 10000);//thay 3000 mili giây thành thời gian hiện thị 1 trích dẫn 

</script>
</div>
@endsection