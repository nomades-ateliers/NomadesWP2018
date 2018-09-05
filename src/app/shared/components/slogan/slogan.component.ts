import { Component, OnInit, ViewEncapsulation, Input } from '@angular/core';

@Component({
  selector: 'app-slogan',
  templateUrl: './slogan.component.html',
  styleUrls: ['./slogan.component.scss'],
  encapsulation: ViewEncapsulation.ShadowDom
})
export class SloganComponent {
  @Input() slogan = '';
}
