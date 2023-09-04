<div id="todo" class="modal">
    <div class="modal__dialog modal__dialog--600">
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">Add Todo</h2>
                <a href="#" class="btn-close btn btn--secondary btn--sm-rounded rounded border-none btn-40"
                   data-close-modal="">
                    <img src="{{asset('main/img/icons/icon-close.svg')}}">
                </a>

            </div>
            <div class="modal__body">
                <div class="mb-12">
                    <label class="label-custom">Todo Title</label>
                    <div class="input-wrap mb-50">
                        <input class="input todo-title" type="text" placeholder="Enter title" value="">
                        <span class="error-message error-title"></span>
                    </div>
                </div>


                    <div class="d-flex justify-content-between">
                        <a href="" class="btn btn--dark btn--md radius-3 ttu cancel-btn">
                            <span class="fs-14">Cancel</span>
                        </a>
                        <a href=""  data-url="{{route('main.profile.user.lender.add-todo')}}" data-close-modal="" class="btn btn--warning btn--md radius-3 ttu add-todo">
                            <span class="fs-14">Save</span>
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>
