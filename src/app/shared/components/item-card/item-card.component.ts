import { Component, OnInit, Input, ViewEncapsulation } from '@angular/core';

@Component({
  selector: 'app-item-card',
  templateUrl: './item-card.component.html',
  styleUrls: ['./item-card.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ItemCardComponent implements OnInit {

  @Input() curcus: any = {title: {rendered: 'default title'}};
  constructor() { }

  ngOnInit() {
    console.log(this.curcus);
  }

}
