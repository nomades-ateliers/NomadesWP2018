declare const grecaptcha: any;
export const loadFile = (component) => {
    // handle errors
    if (typeof grecaptcha !== 'undefined') return;
    if (navigator.onLine === false) return;
    // create script
    const  script: HTMLScriptElement = document.createElement('script');
    script.id = 'g_recaptcha';
    script.async = true;
    // script.defer = true;
    script.src = 'https://www.google.com/recaptcha/api.js';
    // add script to DOM.body
    document.body.appendChild(script);
    // open class method on wondow element
    window['onSubmit'] = (e) => {
        component.onSubmit(e);
    };
  }