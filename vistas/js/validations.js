function validateEmail(email) {
    let re = /\S+@\S+\.\S+/;
     if(!re.test(email)){
         alert("email invalido!")
       document.getElementById("email").value = "";
     }
}

function validatePhone(phone) {
    const onlyNumbersRegExp = /^\d+$/;
    if (!onlyNumbersRegExp.test(phone)) {
        alert("Sólo números!")
        document.getElementById("telefono_correspondencia").value = "";
    }

}

function validateEnergy(id, vlr)
{
    const onlyNumbersRegExp = /^\d+$/;
    if (!onlyNumbersRegExp.test(vlr)) {
        alert("Sólo números!")
        document.getElementById(id).value = 0;
    }
}