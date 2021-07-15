@extends('layouts.master')
@extends('layouts.notlogin')

@section('content')
<body class="antialiased">
      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="topic">
                    <h1>功能B-2-所有需求資料顯示</h1>         
               </div>

待處理需求統計=>
<td class="countdata">業務 : {{count($docNTA)}}&nbsp;
<td class="countdata">網站 : {{count($docNTB)}}&nbsp;
<td class="countdata">客戶 : {{count($docNTC)}}&nbsp;
<p>
已完成需求統計=>
<td class="countdata">業務 : {{count($docYTA)}}&nbsp;
<td class="countdata">網站 : {{count($docYTB)}}&nbsp;
<td class="countdata">客戶 : {{count($docYTC)}}&nbsp;
<p>
</div>


@isset($testN)
@if(count($testN)>0)

<form action="{{ route('exportAll') }}" method="POST">
        @csrf
        <button>Export Excel</button>
</form><p>


        <?php if ($docPage > 0) { ?>
        <form name="SelPage" method="get" action="{{ route('AFourpage') }}">
        @csrf
        第<select name="Page" onchange="submit();">
        <?php 
        for ($p=1; $p<=$docPage; $p++) { 
            echo '  <option value="' . $p . '"';
            if ($p == $page) echo ' selected';
            echo ">$p</option>";
        }
        ?>
        </select>頁 共<?php echo $docPage ?>頁
        </form>
        <?php } ?>
    


    <table class="tableborder">
    <tr>

        <th class="bordertopic">功能</th>
        <th class="bordertopic">部門</th>
        <th class="bordertopic">類型</th>
        <th class="bordertopic">需求描述</th>
        <th class="bordertopic">處理進度</th>
    </tr>
    @php $countitem=0; @endphp

    @foreach($testN as $test1)
    <tfoot>
    <tr>
     @if($countitem>=($page-1)*10 && $countitem<=($page-1)*10+9)
        <td class="textw5 text-a-left">
        <form action="{{ route('updateA', $test1->id) }}" method="POST">
        @csrf
        <button>Finish</button>
        </form>

    <td class="textw5 text-a-center">{{$test1->users_Dep}}&nbsp;
    <td class="textw5 text-a-center">{{$test1->type}}&nbsp;   
    <td class="textw30 text-a-left">&nbsp;{{$test1->request}}<br>
    <td class="textw5 text-a-center">{{$test1->status}}&nbsp;
    </tr>
    </tfoot>
    @endif
    @php $countitem++; @endphp
    @endforeach
@endif 
@endisset

@isset($testY)
@if(count($testY)>0)
    @foreach($testY as $test1)
    <tfoot>
    <tr>
     @if($countitem>=($page-1)*10 && $countitem<=($page-1)*10+9)
        <td class="textw5 text-a-left">

    <td class="textw5 text-a-center">{{$test1->users_Dep}}&nbsp;
    <td class="textw5 text-a-center">{{$test1->type}}&nbsp;   
    <td class="textw30 text-a-left">&nbsp;{{$test1->request}}<br>
    <td class="textw5 text-a-center">{{$test1->status}}&nbsp;
    </tr>
    </tfoot>
    @endif
    @php $countitem++; @endphp
    @endforeach
</table>

@endif 
@endisset
    
    
@if(count($testY)==0 && count($testN)==0)
    <h1>NO Request<h1>
@endif
</p>
<input type ="button" onclick="history.back()" value="Back"></input>
   <a href="/" class="back" style="color:black;font-size:10px;">回首頁</a>
   </div>
</body>
@endsection
