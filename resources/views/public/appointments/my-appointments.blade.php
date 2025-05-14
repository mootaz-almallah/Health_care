@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>مواعيدي</h3>
                    <a href="{{ route('appointments.create') }}" class="btn btn-light">
                        <i class="fas fa-plus-circle me-1"></i> حجز موعد جديد
                    </a>
                </div>
                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success m-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($appointments->isEmpty())
                        <div class="text-center py-5">
                            <img src="https://img.icons8.com/color/96/000000/calendar--v2.png" alt="No Appointments" class="mb-3 opacity-50" width="120">
                            <h4 class="text-muted">لا توجد مواعيد محجوزة حالياً</h4>
                            <p class="text-muted">قم بحجز موعد مع طبيب من خلال الضغط على زر "حجز موعد جديد"</p>
                            <a href="{{ route('appointments.create') }}" class="btn btn-outline-success mt-2">
                                <i class="fas fa-calendar-plus me-1"></i> حجز موعد جديد
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bold">الطبيب</th>
                                        <th class="fw-bold">التخصص</th>
                                        <th class="fw-bold">التاريخ</th>
                                        <th class="fw-bold">الوقت</th>
                                        <th class="fw-bold">الحالة</th>
                                        <th class="fw-bold">حالة الدفع</th>
                                        <th class="fw-bold">إجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($appointment->doctor && $appointment->doctor->image)
                                                        <img src="{{ asset('storage/' . $appointment->doctor->image) }}" alt="{{ $appointment->doctor->name }}" class="rounded-circle me-2" width="40" height="40">
                                                    @else
                                                        <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                            <i class="fas fa-user-md text-white"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <p class="mb-0 fw-medium">{{ $appointment->doctor->name ?? 'غير متوفر' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $appointment->doctor->specialization->name ?? 'غير متوفر' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                            <td>
                                                @php
                                                    $statusClass = [
                                                        'pending' => 'bg-warning',
                                                        'confirmed' => 'bg-success',
                                                        'canceled' => 'bg-danger',
                                                        'completed' => 'bg-info'
                                                    ][$appointment->status] ?? 'bg-secondary';
                                                    
                                                    $statusText = [
                                                        'pending' => 'قيد الانتظار',
                                                        'confirmed' => 'مؤكد',
                                                        'canceled' => 'ملغي',
                                                        'completed' => 'مكتمل'
                                                    ][$appointment->status] ?? $appointment->status;
                                                @endphp
                                                <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $appointment->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $appointment->payment_status == 'paid' ? 'مدفوع' : 'غير مدفوع' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($appointment->status == 'pending')
                                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $appointment->id }}">
                                                        <i class="fas fa-times-circle"></i> إلغاء
                                                    </button>
                                                    
                                                    <!-- Cancel Modal -->
                                                    <div class="modal fade" id="cancelModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="cancelModalLabel{{ $appointment->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger text-white">
                                                                    <h5 class="modal-title" id="cancelModalLabel{{ $appointment->id }}">تأكيد إلغاء الموعد</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>هل أنت متأكد من رغبتك في إلغاء موعدك مع الدكتور {{ $appointment->doctor->name ?? '' }} بتاريخ {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}؟</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">تراجع</button>
                                                                    <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="submit" class="btn btn-danger">تأكيد الإلغاء</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($appointment->status == 'completed')
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-comment-medical"></i> التقييم
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 