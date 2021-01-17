<?php
//
//
//namespace Tests\Unit;
//
//
//use App\Src\Models\Hyper\Auth\ApiTokenModel;
//use App\Src\Models\Hyper\User\UserModel;
//use App\Src\Models\Nmbrs\DocumentModel;
//use App\Src\Repositories\Hyper\User\IUserRepository;
//use App\Src\Repositories\Nmbrs\Upload\IUploadRepository;
//use App\Src\Repositories\Nmbrs\Upload\UploadRepository;
//use App\Src\Services\Nmbrs\Upload\DocumentNmbrsService;
//use Illuminate\Support\Facades\Hash;
//use Tests\TestCase;
//use Mockery as m;
//
//class DocumentUploadTest extends TestCase
//{
//    public function testUploadMethod()
//    {
//        // dit is een object
//        $uploadDocumentRepository = $this->instance(IUploadRepository::class, m::mock(IUploadRepository::class, function ($mock) {
//            $mock->shouldReceive('upload')
//                ->with(m::mock(DocumentModel::class, function ($mock) {
//                    $mock->shouldReceive('getEmployeeId')
//                        ->andReturn(4);
//
//                    $mock->shouldReceive('getDocumentName')
//                        ->andReturn(
//                            makeFileName('naam van het document', '.pdf')
//                        );
//
//                    $mock->shouldReceive('getBody')
//                        ->andReturn(
//                            'bestand.php'
//                        );
//
//                    $mock->shouldReceive('getGuid')
//                        ->andReturn(
//                            'CD4CA39C-CCB4-4685-8EBE-3CE81C2BF382'
//                        );
//                }))
//                ->andReturn();
//        }));
//        $this->assertInstanceOf(UploadRepository::class, $uploadDocumentRepository);
////        $documentModel = m::mock(DocumentModel::class, function ($mock) {
////            $mock->shouldReceive('getEmployeeId')
////                ->andReturn(4);
////
////            $mock->shouldReceive('getDocumentName')
////                ->andReturn(
////                    makeFileName('naam van het document', '.pdf')
////                );
////
////            $mock->shouldReceive('getBody')
////                ->andReturn(
////                    'bestand.php'
////                );
////
////            $mock->shouldReceive('getGuid')
////                ->andReturn(
////                    'CD4CA39C-CCB4-4685-8EBE-3CE81C2BF382'
////                );
////        });
////
////        $userRepository = $this->instance(IUserRepository::class, m::mock(IUserRepository::class, function ($mock) {
////            $mock->shouldReceive('findById')
////                ->with(4)
////                ->andReturn(
////                    m::mock(UserModel::class, function ($mock) {
////                        $mock->shouldReceive('getId')
////                            ->andReturn(4);
////
////                        $mock->shouldReceive('getPassword')
////                            ->andReturn(
////                                Hash::make('123456')
////                            );
////
////                        $mock->shouldReceive('isActive')
////                            ->andReturn(
////                                true
////                            );
////                        $mock->shouldReceive('getNmbrsId')
////                            ->andReturn(4);
////                    })
////                );
////        }));
////
////        $service = new DocumentNmbrsService($uploadDocumentRepository, $userRepository);
////        $result = $service->upload(4, $documentModel);
////        $this->assertInstanceOf(DocumentModel::class, $result);
//    }
//}
