<div class="col-md-4 mb-4">

    <a href="{{ route('healthcare.show', [$type, $item->id]) }}"
       class="text-decoration-none text-dark">

        <div class="card h-100 shadow-sm hover-shadow">

            <img src="{{ $item->image_url }}"
                 class="card-img-top"
                 style="height:200px; object-fit:cover;">

            <div class="card-body">

                <h5>{{ $item->name }}</h5>

                @if(isset($item->specialty))
                    <p class="text-muted">{{ $item->specialty }}</p>
                @endif

                @if(isset($item->working_hours))
                    <p>⏰ {{ $item->working_hours }}</p>
                @endif

                <span class="badge bg-success">
                    خصم {{ $item->discount_percent }}%
                </span>

            </div>

        </div>

    </a>

</div>