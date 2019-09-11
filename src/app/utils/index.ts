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
    console.log('captcha loaded!');
    // open class method on wondow element
    window['onSubmit'] = (e) => {
        component.onSubmit(e);
    };
  }

export const updateHTMLElementHeight = (selectors: string[]) => {
    // for each selectors
    for (let index = 0; index < selectors.length; index++) {
        const s = selectors[index];
        // find all items elements
        const items = Array.from(document.querySelectorAll(s))
        console.log('>_updateHeight items find-> ', items.length);
        // init default maxHeight
        let maxHeight = 0;
        // get height of each element and store the biger in maxHeight
        items.map(i => {
          const iH = i.getBoundingClientRect().height;
          if (iH > maxHeight) maxHeight = iH;
          return i
        })
        // apply maxHeight to all elements
        .map(i => {
          (i as HTMLElement).style.height = `${maxHeight}px`;
          return i;
        })  
        // re-run function if maxHeight is equal to 0 (unsized elements)
        // or if items.length <= 0 (unfinded elements)
        if (items.length <= 0 || maxHeight === 0) {
          // see below why using setTimeout()...
          setTimeout(_=> updateHTMLElementHeight([s]), 2000);
          return;
        }
        // if all elements is resizing, finaly 
        // remove opacity of each containers with small 
        // setTimeout() to prevent ngFor construction debounce time with ionic element (longer to biuld to the DOM)
        // TODO: check with higher ionic version of 4.0.0-beta.13 if the loading time is the same.
        //       if time is faster with new release, you can remove this setTimeOut and refact the method to
        //       remove all setTimeOut() and working with correct angular pattern design.
        setTimeout(_=> 
          (Array.from(document.querySelectorAll('.wks')) || [])
          .map((e: HTMLElement) => {
            e.style.opacity = '1';
          }),
          250
        );
      }
  }
