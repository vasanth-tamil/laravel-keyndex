<div class="col-sm-6 col-lg-3">
    <div class="card card-sm">
        <div class="card-body">
            <div class="row align-items-center">
                {{-- ICON --}}
                <div class="col-auto">
                    <span class="{{ $value->color }} text-white avatar">
                        <i class="ti {{ $value->icon }} fs-2"></i>
                    </span>
                </div>

                {{-- CONTENT --}}
                <div class="col">
                    <div class="font-weight-medium">
                        {{ $value->title }}
                    </div>
                    <div class="text-secondary">
                        {{ $value->subTitle }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
