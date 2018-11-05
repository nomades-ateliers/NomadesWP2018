import { Component, Input, Output, EventEmitter, ViewEncapsulation } from '@angular/core';
import { FileElement } from '../../classes/element';
import { ModalController } from '@ionic/angular';
import { NewFolderDialogComponent } from '@app/features/auth/components/new-folder-dialog/new-folder-dialog.component';

@Component({
  selector: 'app-file-explorer',
  templateUrl: './file-explorer.component.html',
  styleUrls: ['./file-explorer.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class FileExplorerComponent {
  @Input() fileElements: FileElement[];
  @Input() canNavigateUp: string;
  @Input() path: string;

  @Output() folderAdded = new EventEmitter<{ name: string }>();
  @Output() elementRemoved = new EventEmitter<FileElement>();
  @Output() elementRenamed = new EventEmitter<FileElement>();
  @Output() elementMoved = new EventEmitter<{ element: FileElement; moveTo: FileElement }>();
  @Output() navigatedDown = new EventEmitter<FileElement>();
  @Output() navigatedTo = new EventEmitter<FileElement>();
  @Output() navigatedUp = new EventEmitter();

  constructor(
    public modalCtrl: ModalController
  ) {}

  deleteElement(element: FileElement) {
    this.elementRemoved.emit(element);
  }

  navigate(element: FileElement) {
    console.log('elo', 'elemnent');
    if (element.isFolder) {
      console.log('emit', 'navigatedDown');
      this.navigatedDown.emit(element);
    }
  }

  navTo($element) {
    this.navigatedTo.emit($element);
  }
  navigateUp() {
    this.navigatedUp.emit();
  }

  moveElement(element: FileElement, moveTo: FileElement) {
    this.elementMoved.emit({ element: element, moveTo: moveTo });
  }

  async openNewFolderDialog() {
    let modal = await this.modalCtrl.create({
      component: NewFolderDialogComponent
    });
    await modal.present();
    modal
      .onDidDismiss()
      .then((res) => {
        console.log('res', res);
        const { data = null } = res;
        if (data) {
          this.folderAdded.emit({ name: data });
        }
      })
  }

  openRenameDialog(element: FileElement) {

  }

  openMenu(event: MouseEvent, viewChild: any) {

  }
}
