<x-app-layout>
    <!-- Custom CSS for the doctor page navbar -->
    <style>
        /* Make the navbar sky blue */
        .navbar {
            background-color: #4baed1 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        /* Add padding to the top section to accommodate the fixed navbar */
        section {
            padding-top: 100px;
        }
        
        /* Update accent colors to match the blue theme */
        .text-primary {
            color: #3590b0 !important;
        }
        
        .btn-outline-primary {
            border-color: #3590b0 !important;
            color: #3590b0 !important;
        }
        
        .btn-outline-primary:hover {
            background-color: #3590b0 !important;
            color: white !important;
        }
        
        .btn-primary {
            background-color: #3590b0 !important;
            border-color: #3590b0 !important;
        }
        
        /* Make ALL navbar links white */
        .navbar .nav-link,
        .navbar .navbar-brand,
        .navbar .dropdown-toggle,
        .navbar-nav .nav-link,
        .navbar-brand,
        .navbar-dark .navbar-nav .nav-link,
        .navbar-expand-lg .navbar-nav .nav-link,
        .navbar ul.navbar-nav li a.nav-link {
            color: white !important;
        }
        
        .navbar .nav-link:hover,
        .navbar .navbar-brand:hover,
        .navbar-nav .nav-link:hover {
            color: rgba(255, 255, 255, 0.85) !important;
        }
        
        /* Override any default Bootstrap styles */
        .navbar-light .navbar-nav .nav-link {
            color: white !important;
        }
        
        .navbar-light .navbar-brand {
            color: white !important;
        }
        
        /* White buttons in navbar */
        .navbar .btn-auth {
            color: white !important;
        }
    </style>

    <!-- Doctor Details Section -->
    <section class="pt-5 pb-5">
        <div class="container">
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-primary">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('doctors') }}" class="text-primary">الأطباء</a></li>
                    <li class="breadcrumb-item active" aria-current="page">د. {{ $doctor->name }}</li>
                </ol>
            </nav>

            <div class="row">
                <!-- Left Side - Doctor Info -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="bg-white p-5 rounded-xl shadow-lg sticky top-4">
                        <div class="text-center">
                            <div class="relative inline-block">
                                <img src="{{ $doctor->image ? Storage::url($doctor->image) : '/images/team/1.jpg' }}"
                                     class="rounded-full h-36 w-36 border-4 border-white shadow-md object-cover"
                                     alt="Doctor profile">
                                @if($doctor->status === 'approved')
                                <div class="absolute bottom-0 right-0 bg-green-500 text-white p-1 rounded-full">
                                    <i class="icofont-check-circled text-xl"></i>
                                </div>
                                @endif
                            </div>

                            <h2 class="mt-4 text-xl font-bold text-gray-900">Dr. {{ $doctor->name }}</h2>
                            <p class="text-sm text-primary font-medium mb-4">{{ $doctor->specialization->name ?? 'General Practitioner' }}</p>
                        </div>

                        <!-- Appointment Info - Integrated Style -->
                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-sm font-medium text-gray-600 flex items-center">
                                    <i class="icofont-money-bag text-primary mr-2"></i>
                                    Consultation Fee
                                </span>
                                <span class="text-sm font-bold text-primary">{{ number_format($doctor->price_per_appointment, 2) }} JOD</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-sm font-medium text-gray-600 flex items-center">
                                    <i class="icofont-clock-time text-primary mr-2"></i>
                                    Waiting Time
                                </span>
                                <span class="text-sm font-bold text-primary">15-30 min</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-sm font-medium text-gray-600 flex items-center">
                                    <i class="icofont-clock-time text-primary mr-2"></i>
                                    Working Hours
                                </span>
                                <span class="text-sm font-bold text-primary">
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $doctor->working_hours_start)->format('g:i A') }} -
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $doctor->working_hours_end)->format('g:i A') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-600 flex items-center">
                                    <i class="icofont-calendar text-primary mr-2"></i>
                                    Working Days
                                </span>
                                <span class="text-sm font-bold text-primary text-right">
                                    @php
                                        $days = [];
                                        if ($doctor->monday) $days[] = 'Monday';
                                        if ($doctor->tuesday) $days[] = 'Tuesday';
                                        if ($doctor->wednesday) $days[] = 'Wednesday';
                                        if ($doctor->thursday) $days[] = 'Thursday';
                                        if ($doctor->friday) $days[] = 'Friday';
                                        if ($doctor->saturday) $days[] = 'Saturday';
                                        if ($doctor->sunday) $days[] = 'Sunday';
                                    @endphp
                                    {{ implode(', ', $days) }}
                                </span>
                            </div>
                        </div>

                        <div class="flex justify-center gap-2 my-4">
                            <button class="btn btn-outline-primary btn-sm flex items-center">
                                <i class="icofont-ui-messaging mr-1"></i> Message
                            </button>
                            <button class="btn btn-outline-primary btn-sm flex items-center">
                                <i class="icofont-share mr-1"></i> Share
                            </button>
                        </div>

                        <hr class="my-4 border-gray-200">

                        <!-- Contact Info Section -->
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="icofont-location-pin text-primary mt-1 mr-2"></i>
                                <div>
                                    <p class="text-gray-600 text-sm">{{ $doctor->address }}, {{ $doctor->governorate }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="icofont-phone text-primary mt-1 mr-2"></i>
                                <div>
                                    <p class="text-gray-600 text-sm">{{ $doctor->phone ?? 'Not provided' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="icofont-badge text-primary mt-1 mr-2"></i>
                                <div>
                                    <p class="text-gray-600 text-sm">{{ $doctor->experience_years ?? '0' }} years experience</p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 border-gray-200">

                        <!-- Bio Section -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2 text-sm">About</h4>
                            <p class="text-gray-600 text-sm">
                                {{ $doctor->bio ?? 'No biography provided.' }}
                            </p>
                        </div>
                    </div>
                </div>

                 <!-- Right Side - Availability -->
                 <div class="col-lg-8">
                    <div class="bg-white rounded-xl shadow-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Available Slots (Next 14 Days)</h3>

                            @php
                                $today = now();
                                $availableDates = [];
                                $workingDays = [];
                                
                                // Get working days
                                if ($doctor->monday) $workingDays[] = 'Monday';
                                if ($doctor->tuesday) $workingDays[] = 'Tuesday';
                                if ($doctor->wednesday) $workingDays[] = 'Wednesday';
                                if ($doctor->thursday) $workingDays[] = 'Thursday';
                                if ($doctor->friday) $workingDays[] = 'Friday';
                                if ($doctor->saturday) $workingDays[] = 'Saturday';
                                if ($doctor->sunday) $workingDays[] = 'Sunday';

                                // Collect all unavailable times as simple time strings
                                $unavailableSlots = [];
                                foreach ($doctor->unavailable as $unavailable) {
                                    $dateKey = \Carbon\Carbon::parse($unavailable->date)->format('Y-m-d');
                                    $timeKey = \Carbon\Carbon::parse($unavailable->start_time)->format('H:i');

                                    if (!isset($unavailableSlots[$dateKey])) {
                                        $unavailableSlots[$dateKey] = [];
                                    }
                                    $unavailableSlots[$dateKey][] = $timeKey;
                                }

                                // Get available dates within next 14 days
                                for ($i = 0; $i < 14; $i++) {
                                    $date = $today->copy()->addDays($i);
                                    if (in_array($date->format('l'), $workingDays)) {
                                        $availableDates[] = $date;
                                    }
                                }
                            @endphp

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                @foreach($availableDates as $date)
                                    @php
                                        $dateKey = $date->format('Y-m-d');
                                        $isDateUnavailable = isset($unavailableSlots[$dateKey]) &&
                                            in_array('00:00', $unavailableSlots[$dateKey]);
                                    @endphp

                                    <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow">
                                        <h4 class="font-medium text-gray-900 mb-2 text-center text-sm bg-gray-50 py-1 rounded">
                                            @if($date->isToday())
                                                <span class="font-bold text-primary">Today</span>
                                            @elseif($date->isTomorrow())
                                                <span class="font-bold text-primary">Tomorrow</span>
                                            @else
                                                {{ $date->format('D, M j') }}
                                            @endif
                                        </h4>

                                        @if($isDateUnavailable)
                                            <div class="text-center py-4 text-gray-500">
                                                Unavailable all day
                                            </div>
                                        @else
                                            <div class="overflow-y-auto max-h-60 pr-1 custom-scroll">
                                                <div class="space-y-2">
                                                    @php
                                                        $current = \Carbon\Carbon::createFromFormat('H:i:s', $doctor->working_hours_start);
                                                        $endTime = \Carbon\Carbon::createFromFormat('H:i:s', $doctor->working_hours_end);
                                                        $slots = [];
                                                        while($current < $endTime) {
                                                            $slots[] = $current->format('H:i');
                                                            $current->addMinutes(30);
                                                        }
                                                    @endphp

                                                    @foreach($slots as $slot)
                                                        @php
                                                            $slotFormatted = \Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A');
                                                            $isAvailable = !isset($unavailableSlots[$dateKey]) || !in_array($slot, $unavailableSlots[$dateKey]);

                                                            // For today's date, check if the time is in the past
                                                            if ($date->isToday()) {
                                                                $now = \Carbon\Carbon::now()->timezone(config('app.timezone'));
                                                                $slotDateTime = $date->copy()->setTimeFromTimeString($slot)->timezone(config('app.timezone'));

                                                                if ($slotDateTime->lte($now)) {
                                                                    $isAvailable = false;
                                                                }
                                                            }
                                                        @endphp

                                                        @if($isAvailable)
                                                            <div class="bg-gray-50 hover:bg-primary-50 text-gray-700 hover:text-primary-800 text-xs py-2 px-3 rounded text-center cursor-pointer transition-colors border border-gray-100 appointment-slot"
                                                                data-date="{{ $date->format('Y-m-d') }}"
                                                                data-time="{{ $slotFormatted }}">
                                                                {{ $slotFormatted }}
                                                            </div>
                                                        @else
                                                            <div class="bg-gray-100 text-gray-400 text-xs py-2 px-3 rounded text-center line-through">
                                                                {{ $slotFormatted }}
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            @if(count($availableDates) === 0)
                                <p class="text-gray-500 text-center py-6">No available days in the next 14 days</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Appointment Booking Modal -->
    <div class="fixed inset-0 z-50 overflow-y-auto hidden" id="bookingModal">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal content -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modalTitle">
                        Book Appointment
                    </h3>

                    <form id="appointmentForm" method="POST" action="{{ route('appointments.store') }}">
                        @csrf
                        <input type="hidden" name="doctor_id" id="doctor_id" value="{{ $doctor->id }}">
                        <input type="hidden" name="patient_id" id="patient_id" value="{{ auth()->user()->patient->id ?? '' }}">
                        <input type="hidden" name="appointment_date" id="appointment_date">
                        <input type="hidden" name="appointment_time" id="appointment_time">

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Date & Time</label>
                            <p class="text-gray-900" id="displayDateTime"></p>
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="block text-gray-700 text-sm font-medium mb-2">Notes (Optional)</label>
                            <textarea name="notes" id="notes" rows="3" class="shadow-sm focus:ring-primary focus:border-primary mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Consultation Fee</label>
                            <p class="text-gray-900">{{ number_format($doctor->price_per_appointment, 2) }} JOD</p>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
                                Confirm Booking
                            </button>
                            <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: #e2e8f0 #f8fafc;
        }
        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #e2e8f0;
            border-radius: 20px;
        }
    </style>

    <script>
        // Function to open modal with selected date/time
        function openBookingModal(date, time) {
            const modal = document.getElementById('bookingModal');
            const dateInput = document.getElementById('appointment_date');
            const timeInput = document.getElementById('appointment_time');
            const displayElement = document.getElementById('displayDateTime');

            // Format the date for display
            const dateObj = new Date(date);
            const formattedDate = dateObj.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Set the values
            dateInput.value = date;
            timeInput.value = time;
            displayElement.textContent = `${formattedDate} at ${time}`;

            // Show modal
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        // Function to close modal
        function closeModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Add click event listeners to all time slots
        document.addEventListener('DOMContentLoaded', function() {
            const timeSlots = document.querySelectorAll('.appointment-slot');

            timeSlots.forEach(slot => {
                slot.addEventListener('click', function() {
                    const date = this.getAttribute('data-date');
                    const time = this.getAttribute('data-time');
                    openBookingModal(date, time);
                });
            });

            // Close modal when clicking outside
            document.getElementById('bookingModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        });
    </script>
</x-app-layout>