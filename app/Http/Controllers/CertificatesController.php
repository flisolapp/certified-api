<?php

namespace App\Http\Controllers;

use App\Helpers\TermHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificatesController extends Controller
{
    public function search(string $term): JsonResponse
    {
        $term = TermHelper::prepare($term);

        //         $routeContext = RouteContext::fromRequest($request);
        //        $route = $routeContext->getRoute();
        //        // Resolve term in this scope
        //        $term = $route->getArgument('term');
        //        $this->logger->info($term);
        //
        //        $edition = $this->editionUtil->getCurrent();
        //
        //        $repository = $this->em->getRepository(PersonCertificate::class);
        //        $qb = $repository->createQueryBuilder('pc')
        //            ->select('pc')
        //            ->innerJoin('pc.person', 'p')
        //            ->innerJoin('pc.edition', 'e')
        //            ->where('e.id = :editionId')
        //            ->andWhere('(pc.code = :term OR p.email = :term)')
        //            ->andWhere('pc.removedAt IS NULL')
        //            ->setParameter('editionId', $edition->getId())
        //            ->setParameter('term', $term)
        //            // ->orderBy('p.name', 'ASC')
        //            ->addOrderBy('e.year', 'DESC')
        //            // ->addOrderBy('e.year', 'DESC')
        //            ->addOrderBy('pc.name', 'ASC');
        //        $q = $qb->getQuery();
        //
        //        /** @var PersonCertificate[] $items */
        //        $items = $q->execute();
        //
        //        $list = [];
        //        foreach ($items as $item) {
        //            $enjoyedAs = null;
        //            if (!is_null($item->getOrganizer())) //
        //                $enjoyedAs = 'Organizer';
        //            elseif (!is_null($item->getCollaborator())) //
        //                $enjoyedAs = 'Collaborator';
        //            elseif (!is_null($item->getTalk())) //
        //                $enjoyedAs = 'Speaker';
        //            elseif (!is_null($item->getParticipant())) //
        //                $enjoyedAs = 'Participant';
        //
        //            $item = [
        //                'edition' => $item->getEdition()?->getYear(),
        //                'unit' => 'UCB',
        //                'name' => $item->getName(),
        //                'enjoyedAs' => $enjoyedAs,
        //                'code' => $item->getCode(),
        //            ];
        //            $list[] = $item;
        //        }
        //
        //        $body = Psr7\Stream::create(json_encode($list, JSON_PRETTY_PRINT) . PHP_EOL);
        //
        //        return new Psr7\Response(200, ['Content-Type' => 'application/json'], $body);

//        list($project_id, $start, $end) = $this->getParameterFilters($request);
//
//        $records = Report //
//        ::where('project_id', '=', $project_id) //
//        ->where('created_at', '>=', $start . ' 00:00:00') //
//        ->where('created_at', '<=', $end . ' 23:59:59');
//
//        return response()->json($records->get());
        return response()->json();

        // TODO: If not found, response a empty array

        // TODO: Result JSON as
        // [
        //    {
        //        "edition": "2023",
        //        "unit": "UCB",
        //        "name": "Francisco Ernesto Teixeira",
        //        "enjoyedAs": "Participant",
        //        "code": "mz78cBWDO9SN0CBO"
        //    },
        //    {
        //        "edition": "2023",
        //        "unit": "UCB",
        //        "name": "Francisco Ernesto Teixeira",
        //        "enjoyedAs": "Collaborator",
        //        "code": "mr78ZpgdcK14IMcA"
        //    },
        //    {
        //        "edition": "2023",
        //        "unit": "UCB",
        //        "name": "Francisco Ernesto Teixeira",
        //        "enjoyedAs": "Organizer",
        //        "code": "jGzVa9LfmjVDF24e"
        //    }
        // ]
    }

    public function download(string $code): StreamedResponse|JsonResponse
    {
        //         $routeContext = RouteContext::fromRequest($request);
        //        $route = $routeContext->getRoute();
        //        // Resolve code in this scope
        //        $code = $route->getArgument('code');
        //
        //        $repository = $this->em->getRepository(PersonCertificate::class);
        //        $qb = $repository->createQueryBuilder('pc')
        //            ->select('pc')
        //            ->where('pc.code = :certificateCode')
        //            ->andWhere('pc.removedAt IS NULL')
        //            ->setParameter('certificateCode', $code)
        //            ->setMaxResults(1);
        //        $q = $qb->getQuery();
        //
        //        /** @var PersonCertificate[] $items */
        //        $items = $q->execute();
        //
        //        $current = null;
        //        foreach ($items as $item) //
        //            $current = $item;
        //
        //        if (!is_null($current)) {
        //            $editionDir = $this->settings['uploads']['edition'];
        //            $name = $current->getName();
        //            $codeVerificationUrl = 'https://certified.flisol.app/' . $current->getCode();
        //
        //            $font = implode(DIRECTORY_SEPARATOR, [$editionDir, $current->getEdition()?->getId(), 'NunitoSans-Bold.ttf']);
        //
        //            // Disable memory_limit by setting it to minus 1.
        //            ini_set('memory_limit', '-1');
        //
        //            // Disable the time limit by setting it to 0.
        //            set_time_limit(0);
        //
        //            $image = false;
        //
        //            if (!is_null($current->getOrganizer())) {
        //                $certificateFile = implode(DIRECTORY_SEPARATOR, [$editionDir, $current->getEdition()?->getId(), 'certificate_organizer.png']);
        //
        //                if (file_exists($certificateFile)) {
        //                    $image = @imagecreatefrompng($certificateFile);
        //
        //                    $color = imagecolorallocate($image, 240, 240, 240);
        //                    imagefttext($image, 60, 0, 109, 471, $color, $font, $name);
        //
        //                    $color = imagecolorallocate($image, 254, 130, 0);
        //                    imagefttext($image, 60, 0, 108, 470, $color, $font, $name);
        //                }
        //            } elseif (!is_null($current->getCollaborator())) {
        //                $certificateFile = implode(DIRECTORY_SEPARATOR, [$editionDir, $current->getEdition()?->getId(), 'certificate_collaborator.png']);
        //
        //                if (file_exists($certificateFile)) {
        //                    $image = @imagecreatefrompng($certificateFile);
        //
        //                    $color = imagecolorallocate($image, 240, 240, 240);
        //                    imagefttext($image, 60, 0, 109, 471, $color, $font, $name);
        //
        //                    $color = imagecolorallocate($image, 254, 130, 0);
        //                    imagefttext($image, 60, 0, 108, 470, $color, $font, $name);
        //                }
        //            } elseif (!is_null($current->getTalk())) {
        //                $certificateFile = implode(DIRECTORY_SEPARATOR, [$editionDir, $current->getEdition()?->getId(), 'certificate_speaker.png']);
        //                $title = $current->getTalk()->getTitle();
        //
        //                if (file_exists($certificateFile)) {
        //                    $image = @imagecreatefrompng($certificateFile);
        //
        //                    $color = imagecolorallocate($image, 240, 240, 240);
        //                    imagefttext($image, 60, 0, 109, 471, $color, $font, $name);
        //
        //                    $color = imagecolorallocate($image, 254, 130, 0);
        //                    imagefttext($image, 60, 0, 108, 470, $color, $font, $name);
        //
        //                    $color = imagecolorallocate($image, 74, 79, 82);
        //                    imagefttext($image, 18, 0, 114, 570, $color, $font, $title);
        //                }
        //            } elseif (!is_null($current->getParticipant())) {
        //                $certificateFile = implode(DIRECTORY_SEPARATOR, [$editionDir, $current->getEdition()?->getId(), 'certificate_participant.png']);
        //
        //                if (file_exists($certificateFile)) {
        //                    $image = @imagecreatefrompng($certificateFile);
        //
        //                    $color = imagecolorallocate($image, 240, 240, 240);
        //                    imagefttext($image, 60, 0, 109, 471, $color, $font, $name);
        //
        //                    $color = imagecolorallocate($image, 254, 130, 0);
        //                    imagefttext($image, 60, 0, 108, 470, $color, $font, $name);
        //                }
        //            }
        //
        //            if ($image) {
        //                if (!is_null($current->getFederalCode())) //
        //                    $this->certificateUtil->addFederalCode($image, 'CPF', $current->getFederalCode(), 12, 23);
        //
        //                $this->certificateUtil->addCodeVerificationUrl($image, $codeVerificationUrl, 1586, 0);
        //                $this->certificateUtil->addQrCode($image, $codeVerificationUrl, 1280, 780);
        //
        //                header('Content-Type: image/png');
        //                $data = $this->certificateUtil->getData($image);
        //                $stream = $this->streamFactory->createStream($data);
        //
        //                // Update last view of certificate
        //                $current->setLastViewAt(DateTimeImmutable::createFromMutable(new DateTime()));
        //                $this->em->persist($current);
        //                $this->em->flush();
        //
        //                return new Psr7\Response(200, ['Content-Type' => 'image/png'], $stream);
        //            }
        //        }
        //
        //        $body = Psr7\Stream::create(json_encode([
        //                'found' => false,
        //            ], JSON_PRETTY_PRINT) . PHP_EOL);
        //
        //        return new Psr7\Response(404, ['Content-Type' => 'application/json'], $body);

        return response()->streamDownload(function () {
            // Open output stream
            $handle = fopen('php://output', 'w');

//            // Add CSV headers
//            fputcsv($handle, [
//                'id',
//                'name',
//                'email'
//            ]);
//
//            // Get all users
//            foreach (User::all() as $user) {
//                // Add a new row with data
//                fputcsv($handle, [
//                    $user->id,
//                    $user->name,
//                    $user->email
//                ]);
//            }

            // Close the output stream
            fclose($handle);
        }, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="certificate_' . $code . '.png"',
        ]);
    }
}
