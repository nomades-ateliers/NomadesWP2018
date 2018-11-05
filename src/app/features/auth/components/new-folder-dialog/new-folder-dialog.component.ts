import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { ModalController } from '@ionic/angular';

@Component({
  selector: 'app-new-folder-dialog',
  templateUrl: './new-folder-dialog.component.html',
  styleUrls: ['./new-folder-dialog.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class NewFolderDialogComponent {

  folderName: string;

  constructor(public modalCtrl: ModalController) {}

}
