<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown"
    aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-bell"></i>
    @if ($newRequestCount > 0)
        <span id="notification-count" class="notification">{{ $newRequestCount }}</span>
    @endif
</a>
<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
    <li>
        <div class="dropdown-title">
            Bạn có {{ $newRequestCount }} yêu cầu mới
        </div>
    </li>
    <li>
        <div class="scroll-wrapper notif-scroll scrollbar-outer" style="position: relative;">
            <div class="notif-scroll scrollbar-outer scroll-content"
                style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 244px;">
                <div class="notif-center">
                    @foreach ($requests as $request)
                        <a href="{{ route('support-request.show', $request->id) }}">
                            <div class="notif-icon notif-primary">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <div class="notif-content">
                                <span class="block"> <span
                                        style="font-weight: bold">{{ $request->customer->name }}</span> gửi
                                    yêu cầu với tiêu đề <span style="font-weight: bold">{{ $request->title }}</span>
                                </span>
                                <span class="time">{{ $request->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="scroll-element scroll-x">
                <div class="scroll-element_outer">
                    <div class="scroll-element_size"></div>
                    <div class="scroll-element_track"></div>
                    <div class="scroll-bar" style="width: 0px;"></div>
                </div>
            </div>
            <div class="scroll-element scroll-y">
                <div class="scroll-element_outer">
                    <div class="scroll-element_size"></div>
                    <div class="scroll-element_track"></div>
                    <div class="scroll-bar" style="height: 0px;"></div>
                </div>
            </div>
        </div>
    </li>
    <li>
        <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i>
        </a>
    </li>
</ul>
