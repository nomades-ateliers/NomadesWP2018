import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { WorkshopItemComponent } from './workshop-item.component';

describe('WorkshopItemComponent', () => {
  let component: WorkshopItemComponent;
  let fixture: ComponentFixture<WorkshopItemComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ WorkshopItemComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(WorkshopItemComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
