function calculatePasswordStrength(password) {
    var passwordStrength = 'weak';
    
    if (password.match(/[a-z]+/) && password.match(/[A-Z]+/) && password.match(/[0-9]+/) && password.match(/[$-/:-?{-~!"^_`\[\]]/)) {
        if (password.length >= 12) {
            passwordStrength = 'strong';
        } else if (password.length >= 8) {
            passwordStrength = 'medium';
        }
    }
    
    return passwordStrength;
}

document.addEventListener('DOMContentLoaded', function() {
    var passwordInput = document.getElementById('new_password');
    var progressBar = document.querySelector('#password-strength .progress-bar');
    var conditionsList = document.querySelectorAll('#password-conditions .password-condition');
    
    passwordInput.addEventListener('input', function() {
        var password = passwordInput.value;
        var passwordStrength = calculatePasswordStrength(password);
        var conditionsMet = [false, false, false, false, false, false];
        
        if (password.match(/[a-z]+/)) {
            conditionsMet[0] = true;
        }
        
        if (password.match(/[A-Z]+/)) {
            conditionsMet[1] = true;
        }
        
        if (password.match(/[0-9]+/)) {
            conditionsMet[2] = true;
        }
        
        if (password.match(/[$-/:-?{-~!"^_`\[\]]/)) {
            conditionsMet[3] = true;
        }
        
        if (password.length >= 8) {
            conditionsMet[4] = true;
        }
        
        if (password.length >= 12) {
            conditionsMet[5] = true;
        }
        
        conditionsList.forEach(function(condition, index) {
            if (conditionsMet[index]) {
                condition.classList.add('met');
            } else {
                condition.classList.remove('met');
            }
        });
        
        switch(passwordStrength) {
            case 'weak':
                progressBar.classList.remove('bg-warning', 'bg-success');
                progressBar.classList.add('bg-danger');
                progressBar.style.width = '25%';
                progressBar.textContent = 'Weak';
                break;
            case 'medium':
                progressBar.classList.remove('bg-danger', 'bg-success');
                progressBar.classList.add('bg-warning');
                progressBar.style.width = '50%';
                progressBar.textContent = 'Medium';
                break;
            case 'strong':
                progressBar.classList.remove('bg-danger', 'bg-warning');
                progressBar.classList.add('bg-success');
                progressBar.style.width = '100%';
                progressBar.textContent = 'Strong';
                break;
            default:
                progressBar.classList.remove('bg-warning', 'bg-success');
                progressBar.classList.add('bg-danger');
                progressBar.style.width = '25%';
                progressBar.textContent = '';
        }
    });
});
