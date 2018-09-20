import { Component, OnInit, Inject, Input, ViewEncapsulation } from '@angular/core';
import { AppConfig } from '@app/app-config.token';
import { Router } from '@angular/router';

@Component({
  selector: 'app-menu-nav',
  templateUrl: './menu-nav.component.html',
  styleUrls: ['./menu-nav.component.scss'],
  encapsulation: ViewEncapsulation.ShadowDom
})
export class MenuNavComponent implements OnInit {

  public menu: any;
  @Input() currentUrl: string;

  constructor(
    @Inject(AppConfig) public readonly config: any,
    private router: Router
  ) { }

  ngOnInit() {
    // console.log('this.config->', this.config);
    this.menu = this.config.menu;
  }

  goPage(page: any = null) {
    console.log('goPage: ', page);
    if (!page) {
      return this.router.navigate(['/']);
    }
    console.log('page url slug-> ', page.url);
    const url =  `/${(page.url) ? page.url.split('/').reverse()[0] || 'index' : 'index'}`;
    console.log('url', url);
    this.router.navigate([url]);
  }

}
