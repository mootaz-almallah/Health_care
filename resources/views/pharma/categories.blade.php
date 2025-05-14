@include('pharma.__pharma_nav_style')

<div class="container pharma-container">
    <h1 class="pharma-header mb-4">
        <i class="fas fa-th-list me-2"></i> تصنيفات الأدوية
    </h1>

    <div class="row">
        @forelse($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        @if($category->description)
                            <p class="card-text">{{ $category->description }}</p>
                        @endif
                        <a href="{{ route('pharma.index', ['category' => $category->id]) }}" class="btn btn-primary mt-2">
                            <i class="fas fa-pills me-1"></i> عرض الأدوية
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i> لا توجد تصنيفات متاحة حالياً
                </div>
            </div>
        @endforelse
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('pharma.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> العودة إلى قائمة الأدوية
        </a>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Animation on page load
        $('.card').each(function(index) {
            $(this).css('opacity', 0);
            $(this).delay(100 * index).animate({
                opacity: 1
            }, 500);
        });
    });
</script> 