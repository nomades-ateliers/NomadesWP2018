import { Injectable } from '@angular/core';

import { v4 } from 'uuid';
import { FileElement } from '../classes/element';
import { BehaviorSubject } from 'rxjs';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { first, take } from 'rxjs/operators';

export interface IFileService {
  add(fileElement: FileElement);
  delete(id: string);
  update(id: string, update: Partial<FileElement>);
  queryInFolder(folderId: string): Observable<FileElement[]>;
  get(id: string): FileElement;
}

@Injectable()
export class FileService implements IFileService {

  private map = new Map<string, FileElement>();
  private querySubject: BehaviorSubject<FileElement[]>;

  constructor(
    private _http: HttpClient
  ) {}

  add(fileElement: FileElement) {
    fileElement.id = v4();
    this.map.set(fileElement.id, this.clone(fileElement));
    console.log('yyy',this.map);
    
    return fileElement;
  }

  delete(id: string) {
    this.map.delete(id);
  }

  update(id: string, update: Partial<FileElement>) {
    let element = this.map.get(id);
    element = Object.assign(element, update);
    this.map.set(element.id, element);
  }

  queryInFolder(folderId: string) {
    console.log('folderId', folderId);
    const result: FileElement[] = [];
    this.map.forEach(element => {
      if (element.parent === folderId) {
        result.push(this.clone(element));
      }
    });
    if (!this.querySubject) {
      this.querySubject = new BehaviorSubject(result);
    } else {
      this.querySubject.next(result);
    }
    return this.querySubject.asObservable();
    
  }

  get(id: string) {
    return this.map.get(id);
  }

  clone(element: FileElement) {
    return JSON.parse(JSON.stringify(element));
  }

  loadFiles() {
    console.log('deh');
    
    return this._http.get('http://localhost:3000/?user=fazio')
        .pipe()
        .toPromise()
        .then(res => (console.log(res), res))
  }
}
