<style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      font-size: 18px;
      text-align: left;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
    }
    th {
      background-color: #f4f4f4;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
  </style>


<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <button id="companies" onclick="fillContent(this)" style="border: none;
              background-color: transparent;
              color: #007bfe;">companies</button> 
            
          </li>
          <li class="breadcrumb-item">
            <button id="clients" onclick="fillContent(this)" style="border: none;
              background-color: transparent;
              color: #007bfe;">clients</button>
          </li>
          <li class="breadcrumb-item active"  aria-current="page">
             <button id="transferFilter" onclick="fillContent(this)" style="border: none;
              background-color: transparent;
              color: #007bfe;">transfer docs</button>
          </li>
        </ol>
      </nav>
    </div>
  </nav>
  
  <div id="history-content">
  </div>

  
  <!-- model content--> 
  <div class="admin_profile_modal" id="companyDocsModel"  style="display: none">
    <div class="modal-dialog" style="        max-width: fit-content;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Company Docs Modal</h5>
          <button type="button" class="btn-close" onclick="closeCompanyDocsModel()">X</button>
        </div>
        <div id="companyDocsModel_body" class="modal-body">
          <!-- Empty content -->
        </div>
        
      </div>
    </div>
  </div>
