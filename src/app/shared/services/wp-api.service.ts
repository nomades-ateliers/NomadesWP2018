import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { environment } from '@env/environment';
import { of, BehaviorSubject } from 'rxjs';
import { first, tap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class WpApiService {

  private readonly _wpBase = environment.wpBase;

  constructor(public http: HttpClient) { }

  getData(query: {path: string, slug?: string}) {
    // WP API only return response as Array.
    // Force http.get() return response as Array type with <any[]>.
    return  this.http.get<any[]>(this._wpBase + query.path + `?${query.slug}`);
  }

  getRemoteData(query: {path: string, slug: string}) {
    return  this.http.get<any[]>('https://nomades.ch/wp-json/wp/v2/' + query.path + `?${query.slug}`);
  }

  getProjectsData(query: {path: string, slug: string}) {
    return  this.http.get<any[]>('https://nomades-projets.ch/wp-json/wp/v2/' + query.path + `?${query.slug}`);
  }

  async sendMail(data) {
    const headers = new HttpHeaders()
        // .set('cache-control', null)
        // .set('X-Requested-With', null)
        .set('Content-Type', 'application/json');
    console.log('send request...');
    return await this.http.post(
      'https://nomades.ch/inc/ng-processFromContact.php',
      data,
      {
        headers: headers
      }
    ).pipe(first())
    .toPromise()
  }
  async sendInscriptionWorkshop(data) {
    const headers = new HttpHeaders()
    // .set('cache-control', null)
    // .set('X-Requested-With', null)
    .set('Content-Type', 'application/json');
    console.log('send request...');
    return await this.http.post(
      'https://nomades.ch/inc/ng-processWorkInscription.php?ajax=true',
      data,
      {
        headers: headers
      }
    ).pipe(first())
    .toPromise().then(res => (console.log(res), res)).catch(err => err)
  }

  async sendInscription(data) {
    const headers = new HttpHeaders()
        // .set('cache-control', null)
        // .set('X-Requested-With', null)
        .set('Content-Type', 'application/json');
    const formData: FormData = new FormData();
    Object.keys(data).forEach(key => (key !== 'cv') ? formData.append(key, data[key]) : null);
    formData.append('cv', data.cv, data.cv.name);
    console.log('send request...', formData);
    // return await {result: 200};
    return await this.http.post(
      // 'https://nomades.ch/inc/processFromInscription.php',
      'https://nomades.ch/inc/ng-processFromInscription.php?ajax=true',
      formData, // data,
      {
        headers: headers,
        // reportProgress: true,
      }
    ).pipe(first())
    .toPromise().then(res => (console.log(res), res)).catch(err => err)
  }
}
