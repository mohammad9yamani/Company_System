@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active" id="profileTab" onclick="showSection('profile')">Profile</a>
                <a href="#" class="list-group-item list-group-item-action" id="dashboardTab" onclick="showSection('dashboard')">Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action" id="historyTab" onclick="showSection('history')">History</a>
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-danger">Logout</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Profile Section -->
            <div id="profileSection" class="content-section">
                <h3>Profile</h3>

                @if(!$company->email_verified_at)
                    <div class="alert alert-danger">
                        <strong>Message:</strong> Your email is not verified. 
                        <button class="btn btn-link p-0" onclick="sendEmailVerification()">Click here to verify</button>
                    </div>
                @endif

                <form id="profileForm">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $company->address }}" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="updateProfile()">Save Changes</button>
                </form>
            </div>

            <!-- Dashboard Section -->
            <div id="dashboardSection" class="content-section" style="display: none;">
                <h3>Dashboard</h3>
                <p>Dashboard content goes here.</p>
            </div>

            <!-- History Section -->
            <div id="historySection" class="content-section" style="display: none;">
                <h3>History</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Vehicle Number</th>
                            <th>Buyer National ID</th>
                            <th>Seller National ID</th>
                            <th>Cost</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transfers as $transfer)
                            <tr>
                                <td>{{ $transfer->vehicles_num }}</td>
                                <td>{{ $transfer->buyer_national_id }}</td>
                                <td>{{ $transfer->seller_national_id }}</td>
                                <td>{{ $transfer->cost }}</td>
                                <td>{{ ucfirst($transfer->status) }}</td>
                                <td>
                                    @if(in_array($transfer->status, ['appending', 'printed']))
                                        <button class="btn btn-primary" onclick="resumeTransfer('{{ $transfer->id }}')">Resume</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function showSection(section) {

        document.getElementById('profileSection').style.display = 'none';
        document.getElementById('dashboardSection').style.display = 'none';
        document.getElementById('historySection').style.display = 'none';


        document.getElementById('profileTab').classList.remove('active');
        document.getElementById('dashboardTab').classList.remove('active');
        document.getElementById('historyTab').classList.remove('active');


        document.getElementById(`${section}Section`).style.display = 'block';
        document.getElementById(`${section}Tab`).classList.add('active');
    }

    function resumeTransfer(transferId) {
        fetch(`/resume-transfer/${transferId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/main';
            } else {
                alert('Failed to resume the transfer. Please try again.');
            }
        })
        .catch(error => console.error("Error resuming transfer:", error));
    }
</script>

<style>
    .content-section { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
    .list-group-item.active { background-color: #007bff; color: white; }
</style>
@endsection
