import { InjectionToken } from '@angular/core';

export let AppConfig = new InjectionToken<Array<() => void>>('app.config');
