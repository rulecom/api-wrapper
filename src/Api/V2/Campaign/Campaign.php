<?php namespace Rule\ApiWrapper\Api\V2\Campaign;

use Rule\ApiWrapper\Api\Api;
use Rule\ApiWrapper\Client\Request;
use Rule\ApiWrapper\Client\Response;

use \InvalidArgumentException;

class Campaign extends Api
{

    /**
     * Get campaigns
     *
     * @link https://rule.se/apidoc/#campaigns-campaigns-get
     *
     * @param integer $limit Limit for the campaigns count, default 100 max 100
     * @return array Request result
     * @throws \Exception 
     */
    public function getList($limit = 100)
    {
        $request = new Request('campaigns');
        $request->setQuery(['limit' => $limit]);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Get campaign data.
     *
     * @link https://rule.se/apidoc/#campaigns-get-campaign-get
     *
     * @param integer $id Id of the campaign.
     * @return array Request result
     * @throws \Exception
     */
    public function get($id)
    {
        $request = new Request('campaigns');
        $request->setIdParam($id);

        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Get campaign statistics.
     *
     * @link https://rule.se/apidoc/#campaigns-get-statistics-get
     *
     * @param integer $id Id of the campaign.
     * @return array Request result
     * @throws \Exception
     */
    public function statistics($id)
    {
        $request = new Request('campaigns');
        $request->setIdParam($id);
        $request->addSubresource(['name' => 'statistics']);
        $response = $this->client->get($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Send campaign.
     *
     * @link https://rule.se/apidoc/#campaigns-send-campaign-post
     *
     * @param array $campaign Campaign data formated according {@link https://rule.se/apidoc/#campaigns-send-campaign-post}
     * @return array
     * @throws \Exception, InvalidArgumentException
     */
    public function send(array $campaign)
    {
        $this->assertValidCampaign($campaign);

        $request = new Request('campaigns');
        $request->addSubresource(['name' => 'send']);
        $request->setParams($campaign);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Schedule campaign.
     *
     * @link https://rule.se/apidoc/#campaigns-schedule-campaign-post
     *
     * @param array $campaign Campaign data formated according {@link https://rule.se/apidoc/#campaigns-send-campaign-post}
     * @return array
     * @throws \Exception, InvalidArgumentException
     */
    public function schedule(array $campaign)
    {
        $this->assertValidCampaign($campaign);
        $this->assertScheduledCampaign($campaign);

        $request = new Request('campaigns');
        $request->addSubresource(['name' => 'schedule']);
        $request->setParams($campaign);

        $response = $this->client->post($request);

        $this->assertSuccessResponse($response);

        return $response->getData();
    }

    /**
     * Check if campaign is correctly formated
     *
     * @param array $campaign Campaign to validate
     * @throws InvalidArgumentException
     */
    private function assertValidCampaign(array $campaign)
    {
        if (!isset($campaign['subject'])) {
            throw new InvalidArgumentException('subject field should be set');
        }

        if (!isset($campaign['from'])) {
            throw new InvalidArgumentException('from field should be set');
        }

        if (!isset($campaign['message_type'])
            || !in_array($campaign['message_type'], ['email', 'text_message'])) {
            throw new InvalidArgumentException('Appropriate message_type should be set');
        }

        if (!isset($campaign['recipients'])) {
            throw new InvalidArgumentException('Recipients should be set');
        }

        if (!isset($campaign['content'])) {
            throw new InvalidArgumentException('Content should be set');
        }
    }

    /**
     * Check if campaign is scheduled
     *
     * @param array $campaign Campaign to validate
     * @throws InvalidArgumentException
     */
    private function assertScheduledCampaign(array $campaign)
    {
        if (!isset($campaign['send_at'])) {
            throw new InvalidArgumentException('Campaign should be scheduled');
        }
    }
}