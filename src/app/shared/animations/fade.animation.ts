import { trigger, style, animate, transition, query, stagger } from '@angular/animations';

export const fadeAnim =  [
  trigger('listAnimation', [
    transition('* => *', [
      query(
        ':enter',
        [
          style({ opacity: 0, transform: 'translateY(-2rem)' }),
          stagger(
            '50ms',
            animate(
              '550ms ease-out',
              style({ opacity: 1, transform: 'translateY(0px)' })
            )
          )
        ],
        { optional: true }
      ),
      query(':leave', animate('50ms', style({ opacity: 0 })), {
        optional: true
      })
    ])
  ])
];
