/**
 * Contact Form - Validació i animacions
 * Cataclismo Producciones
 */

(function() {
    'use strict';

    // Esperar que el DOM estigui carregat
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('cataclismo-contact-form');
        const formMessage = document.getElementById('form-message');

        if (!form) return;

        // Mostrar missatges de success o error des de URL params
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('contact_success')) {
            showMessage('Missatge enviat correctament! Respondrem aviat.', 'success');
            // Netejar el formulari
            form.reset();
            // Netejar URL
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        if (urlParams.has('contact_error')) {
            const errorMsg = urlParams.get('contact_error');
            showMessage(decodeURIComponent(errorMsg), 'error');
            // Netejar URL
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        // Validació en temps real
        const inputs = form.querySelectorAll('.form-input, .form-textarea');

        inputs.forEach(function(input) {
            // Validar quan l'usuari surt del camp
            input.addEventListener('blur', function() {
                validateField(this);
            });

            // Eliminar error quan l'usuari comença a escriure
            input.addEventListener('input', function() {
                removeFieldError(this);
            });
        });

        // Validació al submit
        form.addEventListener('submit', function(e) {
            let isValid = true;

            inputs.forEach(function(input) {
                if (!validateField(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
                showMessage('Si us plau, completa tots els camps obligatoris correctament.', 'error');

                // Scroll al primer camp amb error
                const firstError = form.querySelector('.form-input.error, .form-textarea.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            } else {
                // Animació del botó
                const submitBtn = form.querySelector('.form-submit-btn');
                submitBtn.innerHTML = '<span class="btn-text">ENVIANT...</span>';
                submitBtn.disabled = true;
            }
        });

        /**
         * Valida un camp individual
         */
        function validateField(field) {
            const value = field.value.trim();
            const isRequired = field.hasAttribute('required');

            removeFieldError(field);

            if (isRequired && !value) {
                addFieldError(field, 'Aquest camp és obligatori');
                return false;
            }

            if (field.type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    addFieldError(field, 'Email no vàlid');
                    return false;
                }
            }

            return true;
        }

        /**
         * Afegeix error visual a un camp
         */
        function addFieldError(field, message) {
            field.classList.add('error');

            // Crear missatge d'error si no existeix
            let errorMsg = field.parentElement.querySelector('.field-error-msg');
            if (!errorMsg) {
                errorMsg = document.createElement('span');
                errorMsg.className = 'field-error-msg';
                field.parentElement.appendChild(errorMsg);
            }
            errorMsg.textContent = message;
        }

        /**
         * Elimina error visual d'un camp
         */
        function removeFieldError(field) {
            field.classList.remove('error');
            const errorMsg = field.parentElement.querySelector('.field-error-msg');
            if (errorMsg) {
                errorMsg.remove();
            }
        }

        /**
         * Mostra missatge general del formulari
         */
        function showMessage(message, type) {
            if (!formMessage) return;

            formMessage.textContent = message;
            formMessage.className = 'form-message ' + type;
            formMessage.style.display = 'block';

            // Scroll al missatge
            formMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

            // Auto-amagar després de 5 segons si és success
            if (type === 'success') {
                setTimeout(function() {
                    formMessage.style.display = 'none';
                }, 5000);
            }
        }

        // Animacions addicionals amb Intersection Observer
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observar elements animables
            const animatedElements = document.querySelectorAll('.contact-info-block, .contact-form-wrapper');
            animatedElements.forEach(function(el) {
                observer.observe(el);
            });
        }
    });

})();
