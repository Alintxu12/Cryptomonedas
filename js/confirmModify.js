<script>
        function confirmModify() {
            // Show a confirmation message before deleting
            var answer = confirm("¿Estás seguro de que quieres modificar esta criptomoneda?");
            if (answer) {
                // User clicked OK
                return true;
            } else {
                // User clicked Cancel
                return false;
            }
        }
    </script>