<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom:32px;">
    <li class="nav-item">
        <a class="nav-link @if($tab == 'type1') active @endif"  href="{{url('admin/data-entry/type1')}}" >Legal Opinion</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab == 'type2') active @endif" href="{{url('admin/data-entry/type2')}}" >Legal Notice</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab == 'type3') active @endif" href="{{url('admin/data-entry/type3')}}">Agricultural Finance</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab == 'type4') active @endif"  href="{{url('admin/data-entry/type4')}}" >Drafting</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab == 'type5') active @endif" href="{{url('admin/data-entry/type5')}}" >Mutation</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab == 'type6') active @endif" href="{{url('admin/data-entry/type6')}}">Court Case</a>
    </li>
</ul>