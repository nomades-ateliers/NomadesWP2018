import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { FileElement } from '@app/features/auth/classes/element';
import { FileService } from '@app/features/auth/services/file.service';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Component({
  selector: 'app-auth-page',
  templateUrl: './auth-page.component.html',
  styleUrls: ['./auth-page.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class AuthPageComponent implements OnInit {

  currentUser: any = {};
  form: FormGroup;

  currentRoot: FileElement;
  currentPath: string = './';
  canNavigateUp = false;

  public fileElements: FileElement[];
  public fileElements$: Observable<FileElement[]>;

  constructor(
    private readonly _formBuilder: FormBuilder,
    private _fileService: FileService) {
    }

  ngOnInit() {
    this._buildForm();
    // this._fileService.add({ name: 'www', isFolder: true, parent: 'root' });
    // const folder_a = this._fileService.add({ name: 'Folder_A', isFolder: true, parent: 'root' });
    // this._fileService.add({ name: 'File_a', isFolder: false, parent: folder_a.id });
    // this.updateFileElementQuery();
    this._loadFiles()

  }

  ionViewWillEnter() {
    // console.log('ionViewWillEnter');
    // this._checkUser();
  }

  async _loadFiles (path = null) {
    console.log(path);
    // if (path) {
    //   this.fileElements = <any> await this._fileService.loadFiles(path)
    //     .then(map((res: any) => res.repoContent))
    //   return;
    // }   
    // main root folder
    this.fileElements = <any> await this._fileService.loadFiles()
    .then(map((res: any) => res.repoContent))
      // .then((res: any) => (res.repoContent.map(r => new FileElement(r)), res))
  
      // .then((res: any) => res.repoContent.map(r => this._fileService.add(r)))
      // .then(() => this.updateFileElementQuery())       
  }

  _buildForm() {
    this.form = this._formBuilder.group({
      name: ['', Validators.compose([Validators.minLength(2), Validators.required])],
      // email: ['', Validators.compose([Validators.email, Validators.required])],
      password: ['', Validators.compose([Validators.minLength(6), Validators.required])]
    });
  }

  _checkUser() {
  }


  addFolder(folder: { name: string }) {
    // console.log('asddFolder');
    // this._fileService.add({ isFolder: true, name: folder.name, parent: this.currentRoot ? this.currentRoot.id : 'root' });
    // this.updateFileElementQuery();
  }

  removeElement(element: FileElement) {
    // console.log('removeElement');
    // this._fileService.delete(element.id);
    // this.updateFileElementQuery();
  }

  navigateToFolder(element: FileElement) {
    
    // this.updateFileElementQuery();
    this.currentPath = this.pushToPath(this.currentPath, element.name);
    // this.canNavigateUp = true;
    this.currentRoot = element;
    this._loadFiles(this.currentPath)
    console.log('navigateToFolder', this.currentRoot, this.currentPath, element);
  }

  navigateUp() {
    // console.log('nabidgtion logc');
    // if (this.currentRoot && this.currentRoot.parent === 'root') {
    //   this.currentRoot = null;
    //   this.canNavigateUp = false;
    //   this.updateFileElementQuery();
    // } else {
    //   this.currentRoot = this._fileService.get(this.currentRoot.parent);
    //   this.updateFileElementQuery();
    // }
    // this.currentPath = this.popFromPath(this.currentPath);
  }

  // move item place
  moveElement(event: { element: FileElement; moveTo: FileElement }) {
    // console.log('move element');
    // this._fileService.update(event.element.id, { parent: event.moveTo.id });
    // this.updateFileElementQuery();
  }

  // remname item
  renameElement(element: FileElement) {
    console.log('rename');
    // this._fileService.update(element.id, { name: element.name });
    this.updateFileElementQuery();
  }

  // upd list file elements
  updateFileElementQuery() {
    // this.fileElements = this._fileService.queryInFolder(this.currentRoot ? this.currentRoot.id : 'root');
  }

  // push path method
  pushToPath(path: string, folderName: string) {
    let p = path ? path : '';
    p += `${folderName}/`;
    return p;
  }

  // pop path method
  popFromPath(path: string) {
    // console.log('popFromPath');
    // let p = path ? path : '';
    // const split = p.split('/');
    // split.splice(split.length - 2, 1);
    // p = split.join('/');
    // return p;
  }

  login() {
    if (!this.form.valid) {
      return;
    }
    console.log(this.form.value);
  }
}
