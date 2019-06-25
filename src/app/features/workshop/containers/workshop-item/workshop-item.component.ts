import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { Observable, of } from 'rxjs';
import { map, tap } from 'rxjs/operators';
import { AlertController } from '@ionic/angular';
import { updateHTMLElementHeight } from '@app/utils';

import { WpApiService } from '@app/shared/services';

@Component({
  selector: 'app-workshop-item',
  templateUrl: './workshop-item.component.html',
  styleUrls: ['./workshop-item.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class WorkshopItemComponent implements OnInit {



  public data$: Observable<any>;
  public allParcours$: Observable<any>;
  public currentParcour: any;
  public parentParcour: any;
  public allParentParcour: any[];
  public subCat: any[];
  public workshops$: Observable<any>;
  public workshopNavRight: any;
  public currentUrl: any;
  public baseUrl = [
    'https://nomades.ch/wp-content/uploads/2018/10/nomade04-.png', // vert
    'https://nomades.ch/wp-content/uploads/2018/11/nomade05_jaune-png.png', // default => TODO: replace by yellow
    'https://nomades.ch/wp-content/uploads/2018/10/nomade03-.png' // bleu
  ];
  public currentSubCat: any;

  constructor(
    private _router: Router,
    private _route: ActivatedRoute,
    public alertController: AlertController,
    private _wpApi: WpApiService) { }

  ngOnInit() {

    this.currentUrl = this._router.url;
    console.log('--', this._router.url.split('/').reverse()[0]);
    this._loadWorkshops();
  }

  private _loadWorkshops() {
    // requestr wp api
    this.workshops$ = this._wpApi.getRemoteData({path: 'workshop', slug: 'per_page=100'}).pipe(
      map(wks => {
        // find current desired workshop
        const w = wks.find(wk => wk.slug === this._router.url.split('/').reverse()[0]);
        // handle unexisting item and return empty array and stop script
        if (!w) {
          return [];
        }
        // extract workshop parcour ID
        const currentParcpourID = w.parcours[0];

        // request to wp api to get all Parcours
        this.allParcours$ = this._wpApi.getRemoteData({path: 'parcours', slug: `per_page=100`}).pipe(
          map(res => (res.length === 1 ) ? res[0] : res),
          tap(parcours => {
            const currentParentCatID = parcours.find(p => p.id === currentParcpourID).parent;
            this.subCat = parcours.filter(p => p.parent === currentParentCatID);
            // this.currentSubCat = this.subCat.filter(c => c)
            console.log('XXXXX', currentParentCatID);
            this.allParentParcour = parcours.filter(p => p.parent === 0)
                                            .map(p => (p.order = +(p.order || 0), p))
                                            .map(p => {
                                              if (p.id === currentParentCatID) {
                                                return {...p, order: 1000};
                                              }
                                              return p;
                                            })
                                            .sort((a, b) => {
                                              return a.order - b.order;
                                            });
          }),
          // find corresponding current parcour by filter all parcour by id equal to workshop.parcour.id
          tap(parcours => this.currentParcour = parcours.find(p => p.id === w.parcours[0])),
          // find corresponding parent parcour by filter all parcour by id equal to current.parcour.parrent
          tap(parcours => this.parentParcour = parcours.find(p => p.id === this.currentParcour.parent))
        );
        // defin current item with finded workshop
        this.data$ = of(w);
        this.workshopNavRight = wks.filter(i => (i || {}).wk_nav === 'oui');
        // return wks array filtered by current.parcour.id
        return wks
        .filter(i => i.parcours.includes(currentParcpourID))
        // remove current selected item from items List
        .filter(i =>  i.id !== w.id)
        .sort((a, b) => a.wk_position - b.wk_position);
      }),
      // if unexisting data, return to the 404 page
      tap(data => (!data[0]) ? window.location.href = '404' : null),
      tap(() => updateHTMLElementHeight(['article.related']))
    );
  }

  goParcour($event, item) {
    this._router.navigate([`./workshops/${item.slug}`]);
  }
  go($event, item) {
    const els = this.currentUrl.split('/');
    els.shift();
    els.pop();
    const url = `${els.join('/')}/${item.slug}`;
    console.log(els.join('/'), item.slug);
    this._router.navigate([url]);
  }

  async inscription(item) {
    console.log(item);

    // const alert = await this.alertController.create({
    //   header: item.title.rendered,
    //   subHeader: 'Pré-inscription',
    //   message: `Vous allez être rediriger vers la page des inscriptions`,
    //   buttons: [
    //     {
    //       text: `Annuler` ,
    //       role: 'cancel',
    //       handler: () => {
    //         console.log('cancel', item.id);
    //       }
    //     },
    //     {
    //       text: `Continuer`,
    //       cssClass: 'secondary',
    //       handler: () => {
    //         console.log('Confirm', item.id);
    //         let data = JSON.parse(localStorage.getItem('nomades_workshop') || '[]');
    //         if (!data.find(i => i.id === item.id)) {
    //           data = [...data, item];
    //         }
    //         localStorage.setItem('nomades_workshop', JSON.stringify(data));
    //         this._router.navigate(['./inscription']);
    //       }
    //     },
    //   ]
    // });

    // await alert.present();
    console.log('Confirm', item.id);
    let data = JSON.parse(localStorage.getItem('nomades_workshop') || '[]');
    if (!data.find(i => i.id === item.id)) {
      data = [...data, item];
    }
    localStorage.setItem('nomades_workshop', JSON.stringify(data));
    this._router.navigate(['./inscription']);
  }
}
