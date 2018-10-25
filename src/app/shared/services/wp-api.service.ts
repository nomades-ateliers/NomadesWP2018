import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { environment } from '@env/environment';
import { of, BehaviorSubject } from 'rxjs';
import { first } from 'rxjs/operators';

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

    // const body = new FormData();
    // body.append('user' , 'login');
    // body.append('password' , 'pass');
    
    const headers = new HttpHeaders()
        .set('cache-control', 'no-cache')
        .set('Content-Type', 'application/json');
    // const params = new HttpParams().set('ajax', JSON.stringify(data));
    return this.http.post(
      'https://nomades.ch/inc/processFromContact.php',
      data,
      {
        headers
      }
    ).pipe(first())
    .toPromise();

    // work with xmlhttprequest
    // const xhr = new XMLHttpRequest();
    // var response = new BehaviorSubject(null);
    // xhr.open("POST", "https://nomades.ch/inc/send.php");
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // xhr.setRequestHeader("Cache-Control", "no-cache");
    // const obs = of(xhr.addEventListener("readystatechange", (e) => e));
    // xhr.send(JSON.stringify(data));
    // return obs;

    // working with fetch()
    // const res = await fetch("https://nomades.ch/inc/send.php", {
    //   method: 'POST',
    //   body: JSON.stringify(data),
    //   headers: {
    //     'Content-Type': 'application/x-www-form-urlencoded'
    //   },
    // });
    // return res
  }
}
