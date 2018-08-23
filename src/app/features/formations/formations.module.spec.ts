import { FormationsModule } from './formations.module';

describe('FormationsModule', () => {
  let formationsModule: FormationsModule;

  beforeEach(() => {
    formationsModule = new FormationsModule();
  });

  it('should create an instance', () => {
    expect(formationsModule).toBeTruthy();
  });
});
