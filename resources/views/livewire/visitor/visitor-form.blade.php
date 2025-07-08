<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Registration</title>
    <style>
        .flex {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .flex div {
            flex: 1;
            min-width: 250px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        h1 {
            margin-top: 30px;
            font-size: 1.5em;
        }

        @media (max-width: 768px) {
            .flex {
                flex-direction: column;
            }

            .flex div {
                width: 100%;
            }
        }
    </style>
</head>
<x-admin.navbar.visitor-header heading="Registration Form">
    <form action="{{ route('visitor') }}" method="post">
        @csrf
        <div class="flex">
            <div>
                <label for="">Client type </label>
                <select name="client_type" id="" >
                    <option value="{{old('client_type')}}">Select</option>
                    <option value="Citizen">Citizen</option>
                    <option value="Business">Business</option>
                    <option value="Government (Employee or Agency)">Government (Employee or Agency)</option>
                </select>

                @error('client_type')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>
        </div>

        <br>
        <h1>Visitor information</h1> <br><br>
        <div class="flex">
            <div>
                <label for="">First Name</label>
                <input type="text" placeholder="" name="first_name"  value="{{old('first_name')}}">

                @error('first_name')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Middle Name</label>
                <input type="text" placeholder="" name="middle_name" value="{{old('middle_name')}}">

                @error('middle_name')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Last Name</label>
                <input type="text" placeholder="" name="last_name" value="{{old('last_name')}}">

                @error('last_name')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Suffix</label>
                <input type="text" placeholder="" name="suffix" value="{{old('suffix')}}">

                @error('suffix')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Sex</label>
                <select name="sex" id="" >
                    <option value="{{old('sex')}}">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                @error('sex')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Birthday</label>
                <input type="date" name="birthday" id="birthday" onchange="calculateAge()"  value="{{old('birthday')}}">

                @error('birthday')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Age</label>
                <input type="text" name="age" id="age" value="{{old('age')}}" readonly>

                @error('age')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Religion</label>
                <input type="text" name="religion"  value="{{old('religion')}}">

                @error('religion')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>
        </div>

        <br>
        <h1>Address</h1> <br><br>
        <div class="flex">
            <div>
                <label for="province">Province</label>
                <select name="" id="province" >
                    <option value="{{old('province')}}">Select Province</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                    @endforeach
                </select>

                @error('province')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="city">City</label>
                <select name="" id="city" >
                    <option value="{{old('city')}}">Select City</option>
                </select>

                @error('city')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="barangay">Barangay</label>
                <select name="" id="barangay" >
                    <option value="{{old('barangay')}}">Select Barangay</option>
                </select>

                @error('barangay')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Street</label>
                <input type="text" name="street" value="{{old('street')}}">

                @error('street')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>
        </div>

        <div class="flex">
            <div>
                <label for="">House/Block/Lot No.</label>
                <input type="text" name="house_no"  value="{{old('house_no')}}">

                @error('house_no')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Email Address.</label>
                <input type="text" name="email"  value="{{old('email')}}">

                @error('email')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Contact no.</label>
                <input type="text" name="contact_no"   value="{{old('contact_no')}}">

                @error('contact_no')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>
                @enderror
            </div>

            <div>
                <label for="">Purpose</label>
                <input type="text" name="purpose"  value="{{old('purpose')}}">

                @error('purpose')
                    <div style="color: red;" >
                        {{ $message }}*
                    </div>`
                @enderror
            </div>
    </div>

    <input type="text" id="selected_city" name="city" value="{{old('city')}}" hidden >
    <input type="text" id="selected_brgy" name="barangay" value="{{old('barangay')}}" hidden >
    <input type="text" id="selected_province" name="province" value="{{old('province')}}" hidden >

    <button type="submit" style="padding: 1em 0; width: 150px; border:none; border-radius: 5px; background-color: #4B4A4A; color:white; font-size: 18px; cursor: pointer;">Save</button>
    </form>
</x-admin.navbar.visitor-header>



<script>
    let city = document.getElementById('selected_city');
    let brgy = document.getElementById('selected_brgy');
    let province = document.getElementById('selected_province');

    document.getElementById('province').addEventListener('change', function () {
        const provinceId = this.value;

        // Clear city and barangay dropdowns
        const citySelect = document.getElementById('city');
        const barangaySelect = document.getElementById('barangay');
        citySelect.innerHTML = '<option value="">Select City</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        if (provinceId) {
            fetch("{{ route('get.cities') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ province_id: provinceId }),
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.city_id}">${city.name}</option>`;
                });
            });
        }
    });

    document.getElementById('city').addEventListener('change', function () {
        const cityId = this.value;

        // Clear barangay dropdown
        const barangaySelect = document.getElementById('barangay');
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        if (cityId) {
            fetch("{{ route('get.barangays') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ city_id: cityId }),
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(barangay => {
                    barangaySelect.innerHTML += `<option value="${barangay.id}">${barangay.name}</option>`;
                });
            });
        }
    });

    document.getElementById('city').addEventListener('change', function () {
    const selectedCity = this.options[this.selectedIndex].text;
    city.value = selectedCity;
    });

    document.getElementById('barangay').addEventListener('change', function () {
        const selectedBarangay = this.options[this.selectedIndex].text;
        brgy.value = selectedBarangay;
    });

    document.getElementById('province').addEventListener('change', function () {
        const selectedProvince = this.options[this.selectedIndex].text;
        province.value = selectedProvince;
    });

</script>


<script>
    function calculateAge() {
        const birthdayInput = document.getElementById('birthday');
        const ageInput = document.getElementById('age');


        const birthdayValue = birthdayInput.value;

        if (birthdayValue) {
            const birthDate = new Date(birthdayValue);
            const today = new Date();

            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }


            ageInput.value = age;
        } else {
            ageInput.value = '';
        }
    }
</script>
