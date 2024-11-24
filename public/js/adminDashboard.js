

function closeCompanyDocsModel() {
    document.getElementById('companyDocsModel').style.display='none';

}

function showCompanyDocs(id) {
    document.getElementById('companyDocsModel').style.display='block';

    fetch('/admin/companyDocsModel', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ id: id })
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();  // Parse the JSON response
    })
    .then(data => {
    
      document.getElementById('companyDocsModel_body').innerHTML = data.htmlSection ;
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
    
    
}

// transferDocs
function transferDocsTable() {
  const companyName = document.getElementById('company_name_select').value;
  const clientSearch = document.getElementById('client_search').value;
  const vehicleSearch = document.getElementById('vehicle_search').value;
  fetch('/admin/transfers', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ 
        company_name: companyName, 
        client_search:clientSearch,
        vehicle_search:vehicleSearch,
      }  )
  })
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();  // Parse the JSON response
  })
  .then(data => {
  
    document.getElementById('transferDocsTable').innerHTML = data.htmlSectionTable ;
  })
  .catch(error => {
    console.error('Error fetching data:', error);
  });
  

  


  
  
}



