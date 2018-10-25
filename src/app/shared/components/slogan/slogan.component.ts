import { Component, OnInit, ViewEncapsulation, Input } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-slogan',
  templateUrl: './slogan.component.html',
  styleUrls: ['./slogan.component.scss'],
  encapsulation: ViewEncapsulation.ShadowDom
})
export class SloganComponent {
  @Input() slogan = '';
  @Input() link = null;

  constructor(
    private _router: Router
  ) {

  }
  go() {
    this._router.navigate([this.link]);
  }
}
