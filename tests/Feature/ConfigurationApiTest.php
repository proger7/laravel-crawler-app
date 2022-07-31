<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Configurations;

class ConfigurationApiTest extends TestCase
{

    public function testGetOAuthToken()
    {
        $data = [
            'username' => 'quantumwise555@gmail.com',
            'password' => 'messi101010',
            'grant_type' => 'password',
            'client_id' => '8',
            'client_secret' => '1FMDmHuCFQnZ1r78hFcJMxAJsTxI13Y4cVoShCAa',
        ];
        $response = $this->json('POST', '/oauth/token', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'token_type',
                'expires_in',
                'access_token',
                'refresh_token'
            ]
        );
    }

    public function testRegister()
    {
        $data = [
            'name' => str_random(),
            'email' => str_random() . '@mail.ru',
            'password' => 'persik123',
            'c_password' => 'persik123'
        ];
        $response = $this->json('POST', '/api/register', $data);
        $response->assertStatus(200);  
    }

    public function testGetListConfigurations()
    {
        $data = [];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmZDJmZTJmMDkxM2ZiMDU2ZmU2NWJkN2FmZmZlNjhmNjk3MWFkYjg4YWY3ODRhMDc1ZDY0OTVkZjhlODQwODM5OWY3OTllMzM2NTRlNTVlIn0.eyJhdWQiOiI4IiwianRpIjoiMWZkMmZlMmYwOTEzZmIwNTZmZTY1YmQ3YWZmZmU2OGY2OTcxYWRiODhhZjc4NGEwNzVkNjQ5NWRmOGU4NDA4Mzk5Zjc5OWUzMzY1NGU1NWUiLCJpYXQiOjE1NjQwNTEzMzQsIm5iZiI6MTU2NDA1MTMzNCwiZXhwIjoxNTk1NjczNzM0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.kECmcTEehAIv72fViCLhZc_UqvHDVhKsmPJO9dMf7pTDIo_URdqyCcITU5znLOGLQhdE0qUmvxLXRn_Pn809f1OFbsGdU8o51z4TuqtgHxO-aLa9TD8Yv4yq0BghUTbTVmp_PnuQAVi9GPHpklAbImZIeMAQmh_gsYVJcnD6q1xoexuLOZIxCIk3faidYI03zpKfPtrHSFbs7lh5Zg-mx3n5nK_lNHwOVGJuDrO2YYuv1maRb9IBUjWE52oLPKLa2SvP6NBVElRtsozp2Al2L-yML3YXHUbVOF_NZmc-d-ehbVAFdQ-AXURsqRbYrUrA_lfPvBNooXyQVecTUc1OLrwEzAv4QhafFaHhybdx59OQHdUiv_82db7HfxoBidC2Uw7khSjHrlH_YGiZWYaIG92Tk-rbY09W1Cf1lCKf-qq2Ff7m4FRNmaqkHcfG6zXiHgpkOtfK-gxpCn_iXM8eMu59EIgxS7ICm_ETqraAlfHAdBxu9X8LE2nDSnHdXt4-HsZt9xBcIp7BwlQdrGt18UaoVusC_b_iOvvGeRGPDtaabzeqf2j0QAtczdBPLWMCpc-uESF3hr0DEj8l_1J72evKxvYRusUU-JEqeIjvUJNelhfXO577FlVuUimgw9as8Vq9CZugfMRqE7Cc_Uo21EQKnbc3SvP2RitNz8iMtg4'
        ];
        $response = $this->json('GET', '/api/configurations', $data, $headers);
        $response->assertStatus(200);   
    }

    public function testCreateConfigurations()
    {
        $data = [
            'v_url' => 'http://persik/' . str_random(),
            'v_site_url' => 'http://persik',
            'v_content_type' => '.container .row',
            'v_filter_type' => 'paginaiton',
            'v_function' => '85_get_Pagination_Element'
        ];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmZDJmZTJmMDkxM2ZiMDU2ZmU2NWJkN2FmZmZlNjhmNjk3MWFkYjg4YWY3ODRhMDc1ZDY0OTVkZjhlODQwODM5OWY3OTllMzM2NTRlNTVlIn0.eyJhdWQiOiI4IiwianRpIjoiMWZkMmZlMmYwOTEzZmIwNTZmZTY1YmQ3YWZmZmU2OGY2OTcxYWRiODhhZjc4NGEwNzVkNjQ5NWRmOGU4NDA4Mzk5Zjc5OWUzMzY1NGU1NWUiLCJpYXQiOjE1NjQwNTEzMzQsIm5iZiI6MTU2NDA1MTMzNCwiZXhwIjoxNTk1NjczNzM0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.kECmcTEehAIv72fViCLhZc_UqvHDVhKsmPJO9dMf7pTDIo_URdqyCcITU5znLOGLQhdE0qUmvxLXRn_Pn809f1OFbsGdU8o51z4TuqtgHxO-aLa9TD8Yv4yq0BghUTbTVmp_PnuQAVi9GPHpklAbImZIeMAQmh_gsYVJcnD6q1xoexuLOZIxCIk3faidYI03zpKfPtrHSFbs7lh5Zg-mx3n5nK_lNHwOVGJuDrO2YYuv1maRb9IBUjWE52oLPKLa2SvP6NBVElRtsozp2Al2L-yML3YXHUbVOF_NZmc-d-ehbVAFdQ-AXURsqRbYrUrA_lfPvBNooXyQVecTUc1OLrwEzAv4QhafFaHhybdx59OQHdUiv_82db7HfxoBidC2Uw7khSjHrlH_YGiZWYaIG92Tk-rbY09W1Cf1lCKf-qq2Ff7m4FRNmaqkHcfG6zXiHgpkOtfK-gxpCn_iXM8eMu59EIgxS7ICm_ETqraAlfHAdBxu9X8LE2nDSnHdXt4-HsZt9xBcIp7BwlQdrGt18UaoVusC_b_iOvvGeRGPDtaabzeqf2j0QAtczdBPLWMCpc-uESF3hr0DEj8l_1J72evKxvYRusUU-JEqeIjvUJNelhfXO577FlVuUimgw9as8Vq9CZugfMRqE7Cc_Uo21EQKnbc3SvP2RitNz8iMtg4'
        ];
        $response = $this->json('POST', '/api/configurations', $data, $headers);
        $response->assertStatus(200);  
    }

    public function testShowConfigurations()
    {
        $data = [];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmZDJmZTJmMDkxM2ZiMDU2ZmU2NWJkN2FmZmZlNjhmNjk3MWFkYjg4YWY3ODRhMDc1ZDY0OTVkZjhlODQwODM5OWY3OTllMzM2NTRlNTVlIn0.eyJhdWQiOiI4IiwianRpIjoiMWZkMmZlMmYwOTEzZmIwNTZmZTY1YmQ3YWZmZmU2OGY2OTcxYWRiODhhZjc4NGEwNzVkNjQ5NWRmOGU4NDA4Mzk5Zjc5OWUzMzY1NGU1NWUiLCJpYXQiOjE1NjQwNTEzMzQsIm5iZiI6MTU2NDA1MTMzNCwiZXhwIjoxNTk1NjczNzM0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.kECmcTEehAIv72fViCLhZc_UqvHDVhKsmPJO9dMf7pTDIo_URdqyCcITU5znLOGLQhdE0qUmvxLXRn_Pn809f1OFbsGdU8o51z4TuqtgHxO-aLa9TD8Yv4yq0BghUTbTVmp_PnuQAVi9GPHpklAbImZIeMAQmh_gsYVJcnD6q1xoexuLOZIxCIk3faidYI03zpKfPtrHSFbs7lh5Zg-mx3n5nK_lNHwOVGJuDrO2YYuv1maRb9IBUjWE52oLPKLa2SvP6NBVElRtsozp2Al2L-yML3YXHUbVOF_NZmc-d-ehbVAFdQ-AXURsqRbYrUrA_lfPvBNooXyQVecTUc1OLrwEzAv4QhafFaHhybdx59OQHdUiv_82db7HfxoBidC2Uw7khSjHrlH_YGiZWYaIG92Tk-rbY09W1Cf1lCKf-qq2Ff7m4FRNmaqkHcfG6zXiHgpkOtfK-gxpCn_iXM8eMu59EIgxS7ICm_ETqraAlfHAdBxu9X8LE2nDSnHdXt4-HsZt9xBcIp7BwlQdrGt18UaoVusC_b_iOvvGeRGPDtaabzeqf2j0QAtczdBPLWMCpc-uESF3hr0DEj8l_1J72evKxvYRusUU-JEqeIjvUJNelhfXO577FlVuUimgw9as8Vq9CZugfMRqE7Cc_Uo21EQKnbc3SvP2RitNz8iMtg4'
        ];

        $item = factory(Configurations::class)->create([
            'v_url' => 'http://persik/' . str_random(),
            'v_site_url' => 'http://persik',
            'v_content_type' => '.container .row',
            'v_filter_type' => 'paginaiton',
            'v_function' => '87_get_Pagination_Element'
        ]);
        $response = $this->json('GET', '/api/configurations/'. $item->id, $data, $headers);
        $response->assertStatus(200);
    }

    public function testUpdateConfigurations()
    {
        $data = [];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmZDJmZTJmMDkxM2ZiMDU2ZmU2NWJkN2FmZmZlNjhmNjk3MWFkYjg4YWY3ODRhMDc1ZDY0OTVkZjhlODQwODM5OWY3OTllMzM2NTRlNTVlIn0.eyJhdWQiOiI4IiwianRpIjoiMWZkMmZlMmYwOTEzZmIwNTZmZTY1YmQ3YWZmZmU2OGY2OTcxYWRiODhhZjc4NGEwNzVkNjQ5NWRmOGU4NDA4Mzk5Zjc5OWUzMzY1NGU1NWUiLCJpYXQiOjE1NjQwNTEzMzQsIm5iZiI6MTU2NDA1MTMzNCwiZXhwIjoxNTk1NjczNzM0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.kECmcTEehAIv72fViCLhZc_UqvHDVhKsmPJO9dMf7pTDIo_URdqyCcITU5znLOGLQhdE0qUmvxLXRn_Pn809f1OFbsGdU8o51z4TuqtgHxO-aLa9TD8Yv4yq0BghUTbTVmp_PnuQAVi9GPHpklAbImZIeMAQmh_gsYVJcnD6q1xoexuLOZIxCIk3faidYI03zpKfPtrHSFbs7lh5Zg-mx3n5nK_lNHwOVGJuDrO2YYuv1maRb9IBUjWE52oLPKLa2SvP6NBVElRtsozp2Al2L-yML3YXHUbVOF_NZmc-d-ehbVAFdQ-AXURsqRbYrUrA_lfPvBNooXyQVecTUc1OLrwEzAv4QhafFaHhybdx59OQHdUiv_82db7HfxoBidC2Uw7khSjHrlH_YGiZWYaIG92Tk-rbY09W1Cf1lCKf-qq2Ff7m4FRNmaqkHcfG6zXiHgpkOtfK-gxpCn_iXM8eMu59EIgxS7ICm_ETqraAlfHAdBxu9X8LE2nDSnHdXt4-HsZt9xBcIp7BwlQdrGt18UaoVusC_b_iOvvGeRGPDtaabzeqf2j0QAtczdBPLWMCpc-uESF3hr0DEj8l_1J72evKxvYRusUU-JEqeIjvUJNelhfXO577FlVuUimgw9as8Vq9CZugfMRqE7Cc_Uo21EQKnbc3SvP2RitNz8iMtg4'
        ];

        $item = factory(Configurations::class)->create([
            'v_url' => 'http://persik/' . str_random(),
            'v_site_url' => 'http://persik',
            'v_content_type' => 'container',
            'v_filter_type' => 'paginaiton',
            'v_function' => '87_get_Pagination_Element'
        ]);
        $params = '/api/configurations/' . $item->id . '?v_url=' . $item->v_url . '&v_site_url=' . $item->v_site_url . '&v_content_type=' . $item->v_content_type . '&v_filter_type=' . $item->v_filter_type . '&v_function=' . $item->v_function;

        $response = $this->json('PUT', $params, $data, $headers);
        $response->assertStatus(200);
    }

    public function testDeleteConfigurations()
    {
        $data = [];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmZDJmZTJmMDkxM2ZiMDU2ZmU2NWJkN2FmZmZlNjhmNjk3MWFkYjg4YWY3ODRhMDc1ZDY0OTVkZjhlODQwODM5OWY3OTllMzM2NTRlNTVlIn0.eyJhdWQiOiI4IiwianRpIjoiMWZkMmZlMmYwOTEzZmIwNTZmZTY1YmQ3YWZmZmU2OGY2OTcxYWRiODhhZjc4NGEwNzVkNjQ5NWRmOGU4NDA4Mzk5Zjc5OWUzMzY1NGU1NWUiLCJpYXQiOjE1NjQwNTEzMzQsIm5iZiI6MTU2NDA1MTMzNCwiZXhwIjoxNTk1NjczNzM0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.kECmcTEehAIv72fViCLhZc_UqvHDVhKsmPJO9dMf7pTDIo_URdqyCcITU5znLOGLQhdE0qUmvxLXRn_Pn809f1OFbsGdU8o51z4TuqtgHxO-aLa9TD8Yv4yq0BghUTbTVmp_PnuQAVi9GPHpklAbImZIeMAQmh_gsYVJcnD6q1xoexuLOZIxCIk3faidYI03zpKfPtrHSFbs7lh5Zg-mx3n5nK_lNHwOVGJuDrO2YYuv1maRb9IBUjWE52oLPKLa2SvP6NBVElRtsozp2Al2L-yML3YXHUbVOF_NZmc-d-ehbVAFdQ-AXURsqRbYrUrA_lfPvBNooXyQVecTUc1OLrwEzAv4QhafFaHhybdx59OQHdUiv_82db7HfxoBidC2Uw7khSjHrlH_YGiZWYaIG92Tk-rbY09W1Cf1lCKf-qq2Ff7m4FRNmaqkHcfG6zXiHgpkOtfK-gxpCn_iXM8eMu59EIgxS7ICm_ETqraAlfHAdBxu9X8LE2nDSnHdXt4-HsZt9xBcIp7BwlQdrGt18UaoVusC_b_iOvvGeRGPDtaabzeqf2j0QAtczdBPLWMCpc-uESF3hr0DEj8l_1J72evKxvYRusUU-JEqeIjvUJNelhfXO577FlVuUimgw9as8Vq9CZugfMRqE7Cc_Uo21EQKnbc3SvP2RitNz8iMtg4'
        ];

        $item = factory(Configurations::class)->create([
            'v_url' => 'http://persik/' . str_random(),
            'v_site_url' => 'http://persik',
            'v_content_type' => '.container .row',
            'v_filter_type' => 'paginaiton',
            'v_function' => '87_get_Pagination_Element'
        ]);

        $response = $this->json('DELETE', '/api/configurations/' . $item->id, $data, $headers);
        $response->assertStatus(200); 
    }

}
