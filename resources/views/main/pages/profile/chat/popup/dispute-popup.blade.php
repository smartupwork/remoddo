<div id="open-dispute" class="modal send-back open-dispute">
    <div class="modal__dialog modal__dialog--600">
        <div class="modal__content">
            <div class="modal__header flex-column">
                <h2 class="modal__title mb-15">Open Dispute</h2>
                <p class="text-center def-text-1 fw-600">
                    To start a dispute, please select the problem category from the following options. 
                    We will then add your support manager to the chat.
                </p>
                <a href="#" class="btn-close btn btn--secondary btn--sm-rounded rounded border-none btn-40" data-close-modal="">
                    <img src="{{asset('main/img/icons/icon-close.svg')}}">
                </a>

            </div>
            <div class="modal__body align-items-center">
                <select class="select-default w-100 reason_inp" >
                    @foreach($problems as $problem)
                    <option value="{{$problem->id}}">{{$problem->title}}</option>
                    @endforeach
                </select>
                <div class="d-flex align-items-center">
                    <a href="#" class="btn btn--warning btn--md radius-3 min-w-150 ttu dispute_btn"
                       data-url="{{route('dispute.chat',['chat'=>$selected_chat])}}">
                        <span class="fs-14">Submit</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
