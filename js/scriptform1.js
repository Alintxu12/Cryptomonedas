<script>
  function validateForm() {
    var name = document.forms[0].name.value;
    var eur = document.forms[0].EUR.value;
    if (name === ""  ||  eur === "" ||  === "") {
      alert("Please fill in all the required fields.");
      return false;
    }
    return confirm("¿Estás seguro de que deseas añadir esta criptomoneda?");
    return true;
   
  }
</script>