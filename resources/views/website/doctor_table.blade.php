<h2>Doctors</h2>

<table id="zero-config" class="table dt-table-hover" style="width:100%">
    <thead>
        <tr class="text-center">
            <th class="text-start">#</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Expertise</th>
            <th class="no-content">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($doctors as $doctor)
        <tr class="text-center">
            <td class="text-start">1</td>
            <td><img src="{{ asset('assets/website/image/images.jpeg') }}"></td>
            <td>{{ $doctor->full_name }}</td>
            <td>Cardiologist</td>
            <td>
                <form method="POST" action="{{ route('book.slot') }}">
                    @csrf
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="doctorId" value="{{ $doctor->id }}">
                    <button type="submit">Book Appointment</button>
                </form>
            </td>
        </tr>
        @endforeach

        {{-- <tr class="text-center">
            <td class="text-start">2</td>
            <td><img src="{{ asset('assets/website/image/images.jpeg') }}"></td>
            <td>John doe</td>
            <td>Cardiologist</td>
            <td>
                <button><a href="" class="appointment">Book Appointment</a></button>
            </td>
        </tr>
        <tr class="text-center">
            <td class="text-start">3</td>
            <td><img src="{{ asset('assets/website/image/images.jpeg') }}"></td>
            <td>John doe</td>
            <td>Cardiologist</td>
            <td>
                <button><a href="" class="appointment">Book Appointment</a></button>
            </td>
        </tr>
        <tr class="text-center">
            <td class="text-start">4</td>
            <td><img src="{{ asset('assets/website/image/images.jpeg') }}"></td>
            <td>John doe</td>
            <td>Cardiologist</td>
            <td>
                <button><a href="" class="appointment">Book Appointment</a></button>
            </td>
        </tr>
        <tr class="text-center">
            <td class="text-start">5</td>
            <td><img src="{{ asset('assets/website/image/images.jpeg') }}"></td>
            <td>John doe</td>
            <td>Cardiologist</td>
            <td>
                <button><a href="" class="appointment">Book Appointment</a></button>
            </td>
        </tr>
        <tr class="text-center">
            <td class="text-start">6</td>
            <td><img src="{{ asset('assets/website/image/images.jpeg') }}"></td>
            <td>John doe</td>
            <td>Cardiologist</td>
            <td>
                <button><a href="" class="appointment">Book Appointment</a></button>
            </td>
        </tr>
        <tr class="text-center">
            <td class="text-start">7</td>
            <td><img src="{{ asset('assets/website/image/images.jpeg') }}"></td>
            <td>John doe</td>
            <td>Cardiologist</td>
            <td>
                <button><a href="" class="appointment">Book Appointment</a></button>
            </td>
        </tr>
        <tr class="text-center">
            <td class="text-start">8</td>
            <td><img src="{{ asset('assets/website/image/images.jpeg') }}"></td>
            <td>John doe</td>
            <td>Cardiologist</td>
            <td>
                <button><a href="" class="appointment">Book Appointment</a></button>
            </td>
        </tr> --}}

    </tbody>
</table>
