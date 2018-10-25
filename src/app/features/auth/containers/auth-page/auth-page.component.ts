import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { FileElement } from '@app/features/auth/classes/element';
import { FileService } from '@app/features/auth/services/file.service';
import { Observable } from 'rxjs';

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
  currentPath: string;
  canNavigateUp = false;

  currentFolder =  './';
  public fileElements: Observable<FileElement[]>;

  constructor(
    private readonly _formBuilder: FormBuilder,
    private _fileService: FileService  ) {
    }

  ngOnInit() {
    this._buildForm();
    this._fileService.add({ name: 'www', isFolder: true, parent: 'root' });
    this._fileService.add({ name: 'Folder_A', isFolder: true, parent: 'root' });
    this._fileService.add({ name: 'File_a', isFolder: false, parent: './Folder_A' });
    this.updateFileElementQuery();
  }

  ionViewWillEnter() {
    console.log('ionViewWillEnter');
    this._checkUser();
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
    console.log('asddFolder');
    this._fileService.add({ isFolder: true, name: folder.name, parent: this.currentRoot ? this.currentRoot.id : 'root' });
    this.updateFileElementQuery();
  }

  removeElement(element: FileElement) {
    console.log('removeElement');
    this._fileService.delete(element.id);
    this.updateFileElementQuery();
  }

  navigateToFolder(element: FileElement) {
    console.log('navToFolder');
    this.currentRoot = element;
    this.updateFileElementQuery();
    this.currentPath = this.pushToPath(this.currentPath, element.name);
    this.canNavigateUp = true;
  }

  navigateUp() {
    console.log('nabidgtion logc');
    if (this.currentRoot && this.currentRoot.parent === 'root') {
      this.currentRoot = null;
      this.canNavigateUp = false;
      this.updateFileElementQuery();
    } else {
      this.currentRoot = this._fileService.get(this.currentRoot.parent);
      this.updateFileElementQuery();
    }
    this.currentPath = this.popFromPath(this.currentPath);
  }

  // move item place
  moveElement(event: { element: FileElement; moveTo: FileElement }) {
    console.log('move element');
    this._fileService.update(event.element.id, { parent: event.moveTo.id });
    this.updateFileElementQuery();
  }

  // remname item
  renameElement(element: FileElement) {
    console.log('rename');
    this._fileService.update(element.id, { name: element.name });
    this.updateFileElementQuery();
  }

  // upd list file elements
  updateFileElementQuery() {
    console.log('updateFileElementQuery');
    this.fileElements = this._fileService.queryInFolder(this.currentRoot ? this.currentRoot.id : 'root');
  }

  // push path method
  pushToPath(path: string, folderName: string) {
    console.log('pushToPath');
    let p = path ? path : '';
    p += `${folderName}/`;
    return p;
  }

  // pop path method
  popFromPath(path: string) {
    console.log('popFromPath');
    let p = path ? path : '';
    const split = p.split('/');
    split.splice(split.length - 2, 1);
    p = split.join('/');
    return p;
  }

  login() {
    if (!this.form.valid) {
      return;
    }
    console.log(this.form.value);
  }
}
