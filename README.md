## installation

- git clone https://github.com/pkjmap/techfriar.git
- composer install
- use POST MAN for testing. 
- payload for POST url
 http://localhost/techfriar/api/save_appointment
- 
<code>{
   "cust_name": "Prathyush",
   "phone": "7907621094",
   "license_path": "Li12Test",
   "vehicle_number": "KL 14 C 2022",
   "start_date_time": "1684280227",
   "end_date_time": "1684580227"
}

</code>
-payload for POST http://localhost/techfriar/api/checkout
<code>
{
   "id": 1
}

</code>
- another url GET http://localhost/techfriar/api/total_list
- I did not do the Vue(frontend part as its time consuming). So License uploading part is not done. BUt if frontent is ready we can upload file with validation and base64_encoding 