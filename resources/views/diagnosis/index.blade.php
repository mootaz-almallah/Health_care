<x-app-layout>
    @push('styles')
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .header {
            background-color: #4a89dc;
            color: white;
            padding: 2rem 0;
            border-radius: 0 0 15px 15px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .symptom-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }
        .symptom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .form-check-input:checked + .form-check-label {
            font-weight: bold;
            color: #4a89dc;
        }
        .symptom-card.selected {
            border: 2px solid #4a89dc;
            background-color: #e8f0fe;
        }
        .submit-btn {
            background-color: #4a89dc;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.12);
            transition: all 0.3s ease;
        }
        .submit-btn:hover {
            background-color: #3a70b5;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
        }
        .card-body {
            padding: 1.5rem;
        }
    </style>
    @endpush

    <div class="header text-center">
        <div class="container">
            <h1><i class="fas fa-heartbeat me-2"></i> Symptom Checker</h1>
            <p class="lead mb-0">Select the symptoms you're experiencing for a preliminary diagnosis</p>
        </div>
    </div>
    
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('predict') }}" id="symptomForm">
                    @csrf
                    <div class="row g-4">
                        @foreach($symptoms as $symptom)
                        <div class="col-md-4 mb-3">
                            <div class="symptom-card" id="card{{ $symptom->id }}">
                                <div class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input symptom-checkbox" type="checkbox" 
                                            name="symptoms[]" 
                                            value="{{ $symptom->symptom_key }}" 
                                            id="symptom{{ $symptom->id }}">
                                        <label class="form-check-label" for="symptom{{ $symptom->id }}">
                                            {{ $symptom->display_name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary submit-btn">
                            <i class="fas fa-search me-2"></i> Check Symptoms
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Make entire card clickable for better UX
        document.querySelectorAll('.symptom-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.type !== 'checkbox') {
                    const checkbox = this.querySelector('.symptom-checkbox');
                    checkbox.checked = !checkbox.checked;
                    
                    // Toggle selected class
                    if (checkbox.checked) {
                        this.classList.add('selected');
                    } else {
                        this.classList.remove('selected');
                    }
                }
            });
        });
        
        // Update card state when checkbox is clicked directly
        document.querySelectorAll('.symptom-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const card = this.closest('.symptom-card');
                if (this.checked) {
                    card.classList.add('selected');
                } else {
                    card.classList.remove('selected');
                }
            });
        });
    </script>
    @endpush
</x-app-layout>