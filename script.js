function sendMail(params){
    var tempParams = {
        from_name: document.getElementById('fromName').value,
        to_name: document.getElementById('toName').value,
        message: document.getElementById('msg').value
    };

    emailjs.send('service_ulcv8o2', 'template_ncv4mva', tempParams)
    .then(function(res){
        console.log('success', res.status);
    });
}