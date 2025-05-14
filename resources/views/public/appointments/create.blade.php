@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0"><i class="fas fa-calendar-plus me-2"></i>حجز موعد جديد</h3>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-times-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="doctor_id" class="form-label fw-bold">اختر الطبيب</label>
                            <select name="doctor_id" id="doctor_id" class="form-select form-select-lg @error('doctor_id') is-invalid @enderror" required>
                                <option value="">-- اختر الطبيب --</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }} - {{ $doctor->specialization->name ?? 'غير محدد' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="appointment_date" class="form-label fw-bold">تاريخ الموعد</label>
                                <input type="date" name="appointment_date" id="appointment_date" 
                                    class="form-control form-control-lg @error('appointment_date') is-invalid @enderror" 
                                    min="{{ date('Y-m-d') }}" 
                                    value="{{ old('appointment_date') }}"
                                    required>
                                @error('appointment_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="appointment_time" class="form-label fw-bold">وقت الموعد</label>
                                <input type="time" name="appointment_time" id="appointment_time" 
                                    class="form-control form-control-lg @error('appointment_time') is-invalid @enderror" 
                                    value="{{ old('appointment_time') }}"
                                    required>
                                @error('appointment_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 p-3 bg-light rounded">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    أوافق على <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">شروط وأحكام</a> الحجز
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-calendar-check me-2"></i>تأكيد الحجز
                            </button>
                            <a href="{{ route('doctors') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>العودة إلى قائمة الأطباء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="termsModalLabel">شروط وأحكام الحجز</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>سياسة الحجز:</h6>
                <ul>
                    <li>يجب الحضور قبل الموعد بـ 15 دقيقة على الأقل.</li>
                    <li>في حالة الرغبة بإلغاء الموعد، يرجى إشعارنا قبل 24 ساعة على الأقل.</li>
                    <li>يجب إحضار البطاقة الشخصية أو جواز السفر.</li>
                    <li>المواعيد المتأخرة عن 15 دقيقة قد يتم إلغاؤها.</li>
                </ul>
                <h6>سياسة الدفع:</h6>
                <ul>
                    <li>يتم الدفع في العيادة قبل الكشف.</li>
                    <li>نقبل الدفع النقدي وبطاقات الائتمان.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">موافق</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Basic validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const doctorSelect = document.getElementById('doctor_id');
            const dateInput = document.getElementById('appointment_date');
            const timeInput = document.getElementById('appointment_time');
            const termsCheckbox = document.getElementById('terms');
            
            let isValid = true;
            
            if (!doctorSelect.value) {
                isValid = false;
                doctorSelect.classList.add('is-invalid');
            } else {
                doctorSelect.classList.remove('is-invalid');
            }
            
            if (!dateInput.value) {
                isValid = false;
                dateInput.classList.add('is-invalid');
            } else {
                dateInput.classList.remove('is-invalid');
            }
            
            if (!timeInput.value) {
                isValid = false;
                timeInput.classList.add('is-invalid');
            } else {
                timeInput.classList.remove('is-invalid');
            }
            
            if (!termsCheckbox.checked) {
                isValid = false;
                termsCheckbox.classList.add('is-invalid');
            } else {
                termsCheckbox.classList.remove('is-invalid');
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection 