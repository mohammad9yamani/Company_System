<div id="transferDocs_Filters" >
    <!-- Filter by Company Name -->
    <label for="company_name">Filter by Company Name:</label>
    <select onchange=" transferDocsTable() " name="company_name" id="company_name_select">
        <option value="">All Companies</option>
        @foreach($companies as $company)
            <option value="{{ $company->name }}" {{ request('company_name') == $company->name ? 'selected' : '' }}>
                {{ $company->name }}
            </option>
        @endforeach
    </select>
    
    <!-- Search for Client -->
    <label for="client_search"> (Seller National ID/Buyer National ID):</label>
    <input onkeyup=" transferDocsTable() " type="text" name="client_search" id="client_search" value="{{ request('client_search') }}" placeholder=" National ID">
    
    <!-- Search for Vehicle -->
    <label for="vehicle_search">Search Vehicle Number:</label>
    <input onkeyup=" transferDocsTable()" type="text" name="vehicle_search" id="vehicle_search" value="{{ request('vehicle_search') }}" placeholder="Vehicle Number">
    
</div>

<div id="transferDocsTable">

</div>