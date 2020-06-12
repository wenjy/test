<?php
/**
 * @author: 文江义
 * @date: 10:54 2020/6/12
 */

$url1 = 'http://kaijiang.500.com/plw.shtml';
$url2 = 'https://kaijiang.aicai.com/pl5/';

$html1 = <<<HTML
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#ADD3EF" class="kj_tablelist02">
					<tbody><tr>
						<td class="td_title01">
							<span class="span_left"><a href="/shtml/plw/20113.shtml" id="link6020">排列5 第 <font class="cfont2"><strong>20113</strong></font>期</a></span>
							<span class="span_right">开奖日期：2020年6月11日 兑奖截止日期：2020年8月9日</span>
						</td>
					</tr>
					<tr align="center">
						<td align="left">
							<table width="100%" border="0" cellspacing="0" cellpadding="1">
								<tbody><tr>
									<td width="80">
										开奖号码：</td>
									<td>
										<div class="ball_box01">
											<ul>
												<li class="ball_orange">0</li>
												<li class="ball_orange">7</li>
												<li class="ball_orange">5</li>
												<li class="ball_orange">0</li>
												<li class="ball_orange">1</li>
											</ul>
										</div>
									</td>
								</tr>
							</tbody></table>
						</td>
					</tr>
					<tr>
						<td>本期全国销售金额：<span class="cfont1 ">12,464,282元</span>  <span style="float:right;margin-right:100px">加奖奖池：<span class="cfont1">438,711,425元</span> </span></td>
					</tr>
				</tbody></table>
HTML;

$html2 = <<<HTML
<div class="lotb_top clearfix">
					
	<div class="lotname">
    	<a href="http://www.aicai.com/pl5/" target="_blank">
        <div class="img">
            <img src="https://r.aicai.com/v2/images/webclient/index/cpdt/i48_pl5.png">
        </div>
        </a>
    </div>
    <div class="lot_js" dataopen="20200611">
    	<p class="lot_kjqs">
    		<strong class="fs14 c333">排列五</strong>
        	<select id="jq_last10_issue_no" name="name_last10_issue_no" onchange="changeIss(203)">
        	      <option value="20113">20113</option>
        	      <option value="20112">20112</option>
        	      <option value="20111">20111</option>
        	      <option value="20110">20110</option>
        	      <option value="20109">20109</option>
        	      <option value="20108">20108</option>
        	      <option value="20107">20107</option>
        	      <option value="20106">20106</option>
        	      <option value="20105">20105</option>
        	      <option value="20104">20104</option>
        	      <option value="20103">20103</option>
        	      <option value="20102">20102</option>
        	      <option value="20101">20101</option>
        	      <option value="20100">20100</option>
        	      <option value="20099">20099</option>
        	      <option value="20098">20098</option>
        	      <option value="20097">20097</option>
        	      <option value="20096">20096</option>
        	      <option value="20095">20095</option>
        	      <option value="20094">20094</option>
        	      <option value="20093">20093</option>
        	      <option value="20092">20092</option>
        	      <option value="20091">20091</option>
        	      <option value="20090">20090</option>
        	      <option value="20089">20089</option>
        	      <option value="20088">20088</option>
        	      <option value="20087">20087</option>
        	      <option value="20086">20086</option>
        	      <option value="20085">20085</option>
        	      <option value="20084">20084</option>
        	      <option value="20083">20083</option>
        	      <option value="20082">20082</option>
        	      <option value="20081">20081</option>
        	      <option value="20080">20080</option>
        	      <option value="20079">20079</option>
        	      <option value="20078">20078</option>
        	      <option value="20077">20077</option>
        	      <option value="20076">20076</option>
        	      <option value="20075">20075</option>
        	      <option value="20074">20074</option>
        	      <option value="20073">20073</option>
        	      <option value="20072">20072</option>
        	      <option value="20071">20071</option>
        	      <option value="20070">20070</option>
        	      <option value="20069">20069</option>
        	      <option value="20068">20068</option>
        	      <option value="20067">20067</option>
        	      <option value="20066">20066</option>
        	      <option value="20065">20065</option>
        	      <option value="20064">20064</option>
        	      <option value="20063">20063</option>
        	      <option value="20062">20062</option>
        	      <option value="20061">20061</option>
        	      <option value="20060">20060</option>
        	      <option value="20059">20059</option>
        	      <option value="20058">20058</option>
        	      <option value="20057">20057</option>
        	      <option value="20056">20056</option>
        	      <option value="20055">20055</option>
        	      <option value="20054">20054</option>
        	      <option value="20053">20053</option>
        	      <option value="20052">20052</option>
        	      <option value="20051">20051</option>
        	      <option value="20050">20050</option>
        	      <option value="20049">20049</option>
        	      <option value="20048">20048</option>
        	      <option value="20047">20047</option>
        	      <option value="20046">20046</option>
        	      <option value="20045">20045</option>
        	      <option value="20044">20044</option>
        	      <option value="20043">20043</option>
        	      <option value="20042">20042</option>
        	      <option value="20041">20041</option>
        	      <option value="20040">20040</option>
        	      <option value="20039">20039</option>
        	      <option value="20038">20038</option>
        	      <option value="20037">20037</option>
        	      <option value="20036">20036</option>
        	      <option value="20035">20035</option>
        	      <option value="20034">20034</option>
        	      <option value="20033">20033</option>
        	      <option value="20032">20032</option>
        	      <option value="20031">20031</option>
        	      <option value="20030">20030</option>
        	      <option value="20029">20029</option>
        	      <option value="20028">20028</option>
        	      <option value="20027">20027</option>
        	      <option value="20026">20026</option>
        	      <option value="20025">20025</option>
        	      <option value="20024">20024</option>
        	      <option value="20023">20023</option>
        	      <option value="20022">20022</option>
        	      <option value="20021">20021</option>
        	      <option value="20020">20020</option>
        	      <option value="20019">20019</option>
        	      <option value="20018">20018</option>
        	      <option value="20017">20017</option>
        	      <option value="20016">20016</option>
        	      <option value="20015">20015</option>
        	      <option value="20014">20014</option>
        	      <option value="20013">20013</option>
        	      <option value="20012">20012</option>
        	      <option value="20011">20011</option>
        	      <option value="20010">20010</option>
        	      <option value="20009">20009</option>
        	      <option value="20008">20008</option>
        	      <option value="20007">20007</option>
        	      <option value="20006">20006</option>
        	      <option value="20005">20005</option>
        	      <option value="20004">20004</option>
        	      <option value="20003">20003</option>
        	      <option value="20002">20002</option>
        	      <option value="20001">20001</option>
        	      <option value="19351">19351</option>
        	      <option value="19350">19350</option>
        	      <option value="19349">19349</option>
        	      <option value="19348">19348</option>
        	      <option value="19347">19347</option>
        	      <option value="19346">19346</option>
        	      <option value="19345">19345</option>
        	      <option value="19344">19344</option>
        	      <option value="19343">19343</option>
        	      <option value="19342">19342</option>
        	      <option value="19341">19341</option>
        	      <option value="19340">19340</option>
        	      <option value="19339">19339</option>
        	      <option value="19338">19338</option>
        	      <option value="19337">19337</option>
        	      <option value="19336">19336</option>
        	      <option value="19335">19335</option>
        	      <option value="19334">19334</option>
        	      <option value="19333">19333</option>
        	      <option value="19332">19332</option>
        	      <option value="19331">19331</option>
        	      <option value="19330">19330</option>
        	      <option value="19329">19329</option>
        	      <option value="19328">19328</option>
        	      <option value="19327">19327</option>
        	      <option value="19326">19326</option>
        	      <option value="19325">19325</option>
        	      <option value="19324">19324</option>
        	      <option value="19323">19323</option>
        	      <option value="19322">19322</option>
        	      <option value="19321">19321</option>
        	      <option value="19320">19320</option>
        	      <option value="19319">19319</option>
        	      <option value="19318">19318</option>
        	      <option value="19317">19317</option>
        	      <option value="19316">19316</option>
        	      <option value="19315">19315</option>
        	      <option value="19314">19314</option>
        	      <option value="19313">19313</option>
        	      <option value="19312">19312</option>
        	      <option value="19311">19311</option>
        	      <option value="19310">19310</option>
        	      <option value="19309">19309</option>
        	      <option value="19308">19308</option>
        	      <option value="19307">19307</option>
        	      <option value="19306">19306</option>
        	      <option value="19305">19305</option>
        	      <option value="19304">19304</option>
        	      <option value="19303">19303</option>
        	      <option value="19302">19302</option>
        	      <option value="19301">19301</option>
        	      <option value="19300">19300</option>
        	      <option value="19299">19299</option>
        	      <option value="19298">19298</option>
        	      <option value="19297">19297</option>
        	      <option value="19296">19296</option>
        	      <option value="19295">19295</option>
        	      <option value="19294">19294</option>
        	      <option value="19293">19293</option>
        	      <option value="19292">19292</option>
        	      <option value="19291">19291</option>
        	      <option value="19290">19290</option>
        	      <option value="19289">19289</option>
        	      <option value="19288">19288</option>
        	      <option value="19287">19287</option>
        	      <option value="19286">19286</option>
        	      <option value="19285">19285</option>
        	      <option value="19284">19284</option>
        	      <option value="19283">19283</option>
        	      <option value="19282">19282</option>
        	      <option value="19281">19281</option>
        	      <option value="19280">19280</option>
        	      <option value="19279">19279</option>
        	      <option value="19278">19278</option>
        	      <option value="19277">19277</option>
        	      <option value="19276">19276</option>
        	      <option value="19275">19275</option>
        	      <option value="19274">19274</option>
        	      <option value="19273">19273</option>
        	      <option value="19272">19272</option>
        	      <option value="19271">19271</option>
        	      <option value="19270">19270</option>
        	      <option value="19269">19269</option>
        	      <option value="19268">19268</option>
        	      <option value="19267">19267</option>
        	      <option value="19266">19266</option>
        	      <option value="19265">19265</option>
        	      <option value="19264">19264</option>
        	      <option value="19263">19263</option>
        	      <option value="19262">19262</option>
        	      <option value="19261">19261</option>
        	      <option value="19260">19260</option>
        	      <option value="19259">19259</option>
        	      <option value="19258">19258</option>
        	      <option value="19257">19257</option>
        	      <option value="19256">19256</option>
        	      <option value="19255">19255</option>
        	      <option value="19254">19254</option>
        	      <option value="19253">19253</option>
        	      <option value="19252">19252</option>
        	      <option value="19251">19251</option>
        	      <option value="19250">19250</option>
        	      <option value="19249">19249</option>
        	      <option value="19248">19248</option>
        	      <option value="19247">19247</option>
        	      <option value="19246">19246</option>
        	      <option value="19245">19245</option>
        	      <option value="19244">19244</option>
        	      <option value="19243">19243</option>
        	      <option value="19242">19242</option>
        	      <option value="19241">19241</option>
        	      <option value="19240">19240</option>
        	      <option value="19239">19239</option>
        	      <option value="19238">19238</option>
        	      <option value="19237">19237</option>
        	      <option value="19236">19236</option>
        	      <option value="19235">19235</option>
        	      <option value="19234">19234</option>
        	      <option value="19233">19233</option>
        	      <option value="19232">19232</option>
        	      <option value="19231">19231</option>
        	      <option value="19230">19230</option>
        	      <option value="19229">19229</option>
        	      <option value="19228">19228</option>
        	      <option value="19227">19227</option>
        	      <option value="19226">19226</option>
        	      <option value="19225">19225</option>
        	      <option value="19224">19224</option>
        	      <option value="19223">19223</option>
        	      <option value="19222">19222</option>
        	      <option value="19221">19221</option>
        	      <option value="19220">19220</option>
        	      <option value="19219">19219</option>
        	      <option value="19218">19218</option>
        	      <option value="19217">19217</option>
        	      <option value="19216">19216</option>
        	      <option value="19215">19215</option>
        	      <option value="19214">19214</option>
        	      <option value="19213">19213</option>
        	      <option value="19212">19212</option>
        	      <option value="19211">19211</option>
        	      <option value="19210">19210</option>
        	      <option value="19209">19209</option>
        	      <option value="19208">19208</option>
        	      <option value="19207">19207</option>
        	      <option value="19206">19206</option>
        	      <option value="19205">19205</option>
        	      <option value="19204">19204</option>
        	      <option value="19203">19203</option>
        	      <option value="19202">19202</option>
        	      <option value="19201">19201</option>
        	      <option value="19200">19200</option>
        	      <option value="19199">19199</option>
        	      <option value="19198">19198</option>
        	      <option value="19197">19197</option>
        	      <option value="19196">19196</option>
        	      <option value="19195">19195</option>
        	      <option value="19194">19194</option>
        	      <option value="19193">19193</option>
        	      <option value="19192">19192</option>
        	      <option value="19191">19191</option>
        	      <option value="19190">19190</option>
        	      <option value="19189">19189</option>
        	      <option value="19188">19188</option>
        	      <option value="19187">19187</option>
        	      <option value="19186">19186</option>
        	      <option value="19185">19185</option>
        	      <option value="19184">19184</option>
        	      <option value="19183">19183</option>
        	      <option value="19182">19182</option>
        	      <option value="19181">19181</option>
        	      <option value="19180">19180</option>
        	      <option value="19179">19179</option>
        	      <option value="19178">19178</option>
        	      <option value="19177">19177</option>
        	      <option value="19176">19176</option>
        	      <option value="19175">19175</option>
        	      <option value="19174">19174</option>
        	      <option value="19173">19173</option>
        	      <option value="19172">19172</option>
        	      <option value="19171">19171</option>
        	      <option value="19170">19170</option>
        	      <option value="19169">19169</option>
        	      <option value="19168">19168</option>
        	      <option value="19167">19167</option>
        	      <option value="19166">19166</option>
        	      <option value="19165">19165</option>
        	      <option value="19164">19164</option>
        	      <option value="19163">19163</option>
        	      <option value="19162">19162</option>
        	      <option value="19161">19161</option>
        	      <option value="19160">19160</option>
        	      <option value="19159">19159</option>
        	      <option value="19158">19158</option>
        	      <option value="19157">19157</option>
        	      <option value="19156">19156</option>
        	      <option value="19155">19155</option>
        	      <option value="19154">19154</option>
        	      <option value="19153">19153</option>
        	      <option value="19152">19152</option>
        	      <option value="19151">19151</option>
        	      <option value="19150">19150</option>
        	      <option value="19149">19149</option>
        	      <option value="19148">19148</option>
        	      <option value="19147">19147</option>
        	      <option value="19146">19146</option>
        	      <option value="19145">19145</option>
        	      <option value="19144">19144</option>
        	      <option value="19143">19143</option>
        	      <option value="19142">19142</option>
        	      <option value="19141">19141</option>
        	      <option value="19140">19140</option>
        	      <option value="19139">19139</option>
        	      <option value="19138">19138</option>
        	      <option value="19137">19137</option>
        	      <option value="19136">19136</option>
        	      <option value="19135">19135</option>
        	      <option value="19134">19134</option>
        	      <option value="19133">19133</option>
        	      <option value="19132">19132</option>
        	      <option value="19131">19131</option>
        	      <option value="19130">19130</option>
        	      <option value="19129">19129</option>
        	      <option value="19128">19128</option>
        	      <option value="19127">19127</option>
        	      <option value="19126">19126</option>
        	      <option value="19125">19125</option>
        	      <option value="19124">19124</option>
        	      <option value="19123">19123</option>
        	      <option value="19122">19122</option>
        	      <option value="19121">19121</option>
        	      <option value="19120">19120</option>
        	      <option value="19119">19119</option>
        	      <option value="19118">19118</option>
        	      <option value="19117">19117</option>
        	      <option value="19116">19116</option>
        	      <option value="19115">19115</option>
        	      <option value="19114">19114</option>
        	      <option value="19113">19113</option>
        	      <option value="19112">19112</option>
        	      <option value="19111">19111</option>
        	      <option value="19110">19110</option>
        	      <option value="19109">19109</option>
        	      <option value="19108">19108</option>
        	      <option value="19107">19107</option>
        	      <option value="19106">19106</option>
        	      <option value="19105">19105</option>
        	      <option value="19104">19104</option>
        	      <option value="19103">19103</option>
        	      <option value="19102">19102</option>
        	      <option value="19101">19101</option>
        	      <option value="19100">19100</option>
        	      <option value="19099">19099</option>
        	      <option value="19098">19098</option>
        	      <option value="19097">19097</option>
        	      <option value="19096">19096</option>
        	      <option value="19095">19095</option>
        	      <option value="19094">19094</option>
        	      <option value="19093">19093</option>
        	      <option value="19092">19092</option>
        	      <option value="19091">19091</option>
        	      <option value="19090">19090</option>
        	      <option value="19089">19089</option>
        	      <option value="19088">19088</option>
        	      <option value="19087">19087</option>
        	      <option value="19086">19086</option>
        	      <option value="19085">19085</option>
        	      <option value="19084">19084</option>
        	      <option value="19083">19083</option>
        	      <option value="19082">19082</option>
        	      <option value="19081">19081</option>
        	      <option value="19080">19080</option>
        	      <option value="19079">19079</option>
        	      <option value="19078">19078</option>
        	      <option value="19077">19077</option>
        	      <option value="19076">19076</option>
        	      <option value="19075">19075</option>
        	      <option value="19074">19074</option>
        	      <option value="19073">19073</option>
        	      <option value="19072">19072</option>
        	      <option value="19071">19071</option>
        	      <option value="19070">19070</option>
        	      <option value="19069">19069</option>
        	      <option value="19068">19068</option>
        	      <option value="19067">19067</option>
        	      <option value="19066">19066</option>
        	      <option value="19065">19065</option>
        	      <option value="19064">19064</option>
        	      <option value="19063">19063</option>
        	      <option value="19062">19062</option>
        	      <option value="19061">19061</option>
        	      <option value="19060">19060</option>
        	      <option value="19059">19059</option>
        	      <option value="19058">19058</option>
        	      <option value="19057">19057</option>
        	      <option value="19056">19056</option>
        	      <option value="19055">19055</option>
        	      <option value="19054">19054</option>
        	      <option value="19053">19053</option>
        	      <option value="19052">19052</option>
        	      <option value="19051">19051</option>
        	      <option value="19050">19050</option>
        	      <option value="19049">19049</option>
        	      <option value="19048">19048</option>
        	      <option value="19047">19047</option>
        	      <option value="19046">19046</option>
        	      <option value="19045">19045</option>
        	      <option value="19044">19044</option>
        	      <option value="19043">19043</option>
        	      <option value="19042">19042</option>
        	      <option value="19041">19041</option>
        	      <option value="19040">19040</option>
        	      <option value="19039">19039</option>
        	      <option value="19038">19038</option>
        	      <option value="19037">19037</option>
        	      <option value="19036">19036</option>
        	      <option value="19035">19035</option>
        	      <option value="19034">19034</option>
        	      <option value="19033">19033</option>
        	      <option value="19032">19032</option>
        	      <option value="19031">19031</option>
        	      <option value="19030">19030</option>
        	      <option value="19029">19029</option>
        	      <option value="19028">19028</option>
        	      <option value="19027">19027</option>
        	      <option value="19026">19026</option>
        	      <option value="19025">19025</option>
        	      <option value="19024">19024</option>
        	      <option value="19023">19023</option>
        	      <option value="19022">19022</option>
        	      <option value="19021">19021</option>
        	      <option value="19020">19020</option>
        	      <option value="19019">19019</option>
        	      <option value="19018">19018</option>
        	      <option value="19017">19017</option>
        	      <option value="19016">19016</option>
        	      <option value="19015">19015</option>
        	      <option value="19014">19014</option>
        	      <option value="19013">19013</option>
        	      <option value="19012">19012</option>
        	      <option value="19011">19011</option>
        	      <option value="19010">19010</option>
        	      <option value="19009">19009</option>
        	      <option value="19008">19008</option>
        	      <option value="19007">19007</option>
        	      <option value="19006">19006</option>
        	      <option value="19005">19005</option>
        	      <option value="19004">19004</option>
        	      <option value="19003">19003</option>
        	      <option value="19002">19002</option>
        	      <option value="19001">19001</option>
        	      <option value="18358">18358</option>
        	      <option value="18357">18357</option>
        	      <option value="18356">18356</option>
        	      <option value="18355">18355</option>
        	      <option value="18354">18354</option>
        	      <option value="18353">18353</option>
        	      <option value="18352">18352</option>
        	      <option value="18351">18351</option>
        	      <option value="18350">18350</option>
        	      <option value="18349">18349</option>
        	      <option value="18348">18348</option>
        	      <option value="18347">18347</option>
        	      <option value="18346">18346</option>
        	      <option value="18345">18345</option>
        	      <option value="18344">18344</option>
        	      <option value="18343">18343</option>
        	      <option value="18342">18342</option>
        	      <option value="18341">18341</option>
        	      <option value="18340">18340</option>
        	      <option value="18339">18339</option>
        	      <option value="18338">18338</option>
        	      <option value="18337">18337</option>
        	      <option value="18336">18336</option>
        	      <option value="18335">18335</option>
        	      <option value="18334">18334</option>
        	      <option value="18333">18333</option>
        	      <option value="18332">18332</option>
        	      <option value="18331">18331</option>
        	      <option value="18330">18330</option>
        	      <option value="18329">18329</option>
        	      <option value="18328">18328</option>
        	      <option value="18327">18327</option>
        	      <option value="18326">18326</option>
        	      <option value="18325">18325</option>
        	      <option value="18324">18324</option>
        	      <option value="18323">18323</option>
        	</select>	            		            	
        	开奖日期：<span id="jq_short_openTime">06-11</span>  每天开奖  
        	
    	        <a href="http://faq.aicai.com/rule/pl5/" class="lot_text" target="_blank">玩法</a>
            
        </p>
        <div class="lot_kjmub">
        	<div id="jq_openResult" class="kj_ball lot_i">               	
                <i>0</i><i>7</i><i>5</i><i>0</i><i>1</i>
        	</div>
            
		        <span class="alink"><a href="http://zst.aicai.com/pl5/" target="_blank">号码走势</a>|<a href="javascript:void(0);" onclick="clickOutprint(203);return false;">导出开奖</a></span>
		                        
        </div>
        <p>全国销量：￥<i id="jq_saleValue" class="red">12,464,282</i>元  <span class="lot_text">奖池滚存：￥<i id="jq_poolsValue" class="red">0</i>元</span></p>
     </div>
<!--广告-->
					<a href="javascript:;" class="addVedio" onclick="toKjsp(203)">
						<i>
							<svg t="1586487001009" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1212" width="12" height="12"><path d="M113.777778 1024 113.777778 0 910.222222 512 113.777778 1024Z" p-id="1213" fill="#ffffff"></path></svg>
						</i>
						开奖视频
					</a>
			    </div>
HTML;

//$html1 = file_get_contents($url1);
//var_dump($html1);
$pattern = '/<li class="ball_orange">(?<num>\w+)<\/li>/';
var_dump(preg_match_all($pattern, $html1, $matches1));
var_dump($matches1['num']);
var_dump(strtotime('20200611'));
var_dump(strtotime(str_replace(['年', '月', '日'], '', '2020年6月11日')));
preg_match('/开奖日期：(?<y>\w{4})年(?<m>\w+)月(?<d>\w+)日/', $html1, $matches3);
var_dump($matches3);

/*$html2 = file_get_contents($url2);
$pattern = '/<i>(?<num>\w+)<\/i>/';
var_dump(preg_match_all($pattern, $html2, $matches2));
var_dump($matches2['num']);*/
preg_match('/dataopen="(?<date>\w{8})"/', $html2, $matches4);
var_dump($matches4);
// 21：55-22：00




