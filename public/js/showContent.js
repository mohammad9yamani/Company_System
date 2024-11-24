function fillContent(id){
    // alert (id.id);
     fillControlPanel(id.id)
 }
 
 function fillControlPanel(id){
   // alert (id);
    // جلب البيانات من Laravel API باستخدام fetch
    fetch('/admin/'+id)
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();  // Parse the JSON response
    })
    .then(data => {
      if (id=='profile' || id=='tabDashboard' || id=='history'){
        document.getElementById('main-content').innerHTML = data.htmlSection ;
      
      }else{ 
        document.getElementById('history-content').innerHTML = data.htmlSection ;
        if(id=='transferFilter'){
          transferDocsTable();
        }
      }  
     
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
 } 






 