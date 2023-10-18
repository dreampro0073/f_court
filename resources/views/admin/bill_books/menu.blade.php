<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom:32px;">
    <li class="nav-item">
        <a class="nav-link @if($tab == 'type1') active @endif"  href="{{url('admin/bill-books/type1')}}" >Temp Bills</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab == 'type2') active @endif" href="{{url('admin/bill-books/type2')}}" >Bill Books</a>
    </li>
</ul>